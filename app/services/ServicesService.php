<?php

namespace common\services;

use api\models\bids\BidDetailsResult;
use api\models\bids\BidsResult;
use api\models\bids\BidTypesResult;
use api\models\bids\BundlesResult;
use api\models\bids\RequestDetailsApiModel;
use api\models\bids\RequestDetailsResult;
use api\models\business\BusinessCategoriesResult;
use api\models\business\BusinessDetailsResult;
use api\models\lists\CategoriesResult;
use api\models\lists\ChambersResult;
use api\models\location\RegionResult;
use api\models\location\CityResult;
use api\models\location\CountryResult;
use api\models\location\LocationResult;
use api\models\location\StateResult;
use api\models\other\ApiMessage;
use api\models\product\ProductCategoriesResult;
use api\models\product\ProductDetailsResult;
use api\models\product\ProductsResult;
use api\models\product\ReviewsListResult;
use api\models\services\RequestFileResult;
use api\models\services\ServicesResult;
use common\enums\ActiveInactiveStatus;
use common\enums\CategoryType;
use common\enums\Constents;
use common\enums\ErrorCode;
use common\enums\PublishStatus;
use common\enums\RequestStatus;
use common\enums\RequestType;
use common\enums\SubscriptionStatus;
use common\interfaces\ILocationInterface;
use common\models\Area;
use common\models\Bid;
use common\models\BidType;
use common\models\Buisness;
use common\models\Bundle;
use common\models\Business;
use common\models\Category;
use common\models\CategoryBuisness;
use common\models\CategoryBusiness;
use common\models\Chamber;
use common\models\City;
use common\models\Country;
use common\models\Favorite;
use common\models\notifications\Notification;
use common\models\notifications\request\NewOrderNotification;
use common\models\Product;
use common\models\Review;
use common\models\Service;
use common\models\State;
use common\models\TypeBid;
use common\models\TypeService;
use common\models\UserRequest;
use common\models\UserRequestAttachemnt;
use common\models\UserSubscription;
use common\models\UserSubscriptionType;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class ServicesService {

    public static function services($type = '') {
        $query = Service::find()
        ;
        if($type && $type != '{type}' && $type != ','){
            $query = $query->andWhere(['type' => $type]);
        }

        $data = [];
        foreach ($query->all() as $one){
            $item = FillApiModelService::FillServiceApiModel($one);
            $data[] = $item;
        }

        $res = new ServicesResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function serviceTypes($type = '') {
        $query = TypeBid::find()
            ->andWhere(['status' => ActiveInactiveStatus::active])
        ;
        if($type && $type != '{type}' && $type != ','){
            $query = $query->andWhere(['type' => $type]);
        }

        $data = [];
        foreach ($query->all() as $one){
            $item = FillApiModelService::FillBidTypeApiModel($one);
            $data[] = $item;
        }

        $res = new BidTypesResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function sendRequest($post) {
        if(!$post->service_type || !$post->type_id){
            throw new \yii\web\HttpException(200, t('Missing data!'), 200);
        }

        if(!in_array($post->service_type, [RequestType::commercial_register, RequestType::certification_service])){
            throw new \yii\web\HttpException(200, t("Can't create request for bid from here!"), 200);
        }

        $types = [];
        $type = TypeBid::find()
            ->andWhere(['id' => $post->type_id])
            ->andWhere(['type' => $post->service_type])
            ->andWhere(['status' => ActiveInactiveStatus::active])
            ->one();
        if($type){
            $types[$type->id] = $type->id;
        }
        if(!$types){
            throw new \yii\web\HttpException(200, t('Type not found'), 200);
        }

        //find request if already sent
        $request = UserRequest::find()
            ->andWhere(['user_id' => userId()])
            ->andWhere(['request_type' => $post->service_type])
            ->andWhere(['in', 'status', [RequestStatus::new_request, RequestStatus::under_process]])
            ->one();
        if($request){
            throw new \yii\web\HttpException(200, t('Request already sent'), 200);
        }

        //else create new request
        $request = new UserRequest();
        $request->create_date = date(Constents::full_date_format);
        $request->status = RequestStatus::new_request;
        $request->request_type = $post->service_type;
        $request->user_id = userId();
        if(!$request->save()){
            stopv($request->errors);
        }
        foreach ($types as $one){
            $attachment = new UserRequestAttachemnt();
            $attachment->request_id = $request->id;
            $attachment->bid_type_id = $one;
            if(!$attachment->save()){
                stopv($attachment->errors);
            }
        }

        //send notification
        Notification::send(new NewOrderNotification($request));
        //

        if(isset($post->file_id)){
            foreach ($post->file_id as $one){
                $file = UserRequestAttachemnt::findOne($one);
                if($file){
                    $file->request_id = $request->id;
                    if(!$file->save()){
                        throw new \yii\web\HttpException(200, t('error saving file'), 200);
                    }
                }
            }
        }

        $data = FillApiModelService::FillRequestDetailsApiModel($request);

        $res = new RequestDetailsResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }

    public static function uploadRequestFile($post) {
        $request_id = null;
        if(isset($post->request_id) && $post->request_id){
            $request = UserRequest::findOne($post->request_id);
            if(!$request){
                throw new \yii\web\HttpException(200, "Request not found", 200);
            }
            if($request->user_id != userId()){
                throw new \yii\web\HttpException(200, "Not your request", 200);
            }
            if($request->status != RequestStatus::new_request){
                throw new \yii\web\HttpException(200, "Request already reviewed!, Can't change.", 200);
            }
            $request_id = $request->id;
        }
        //save file
        $file = UploadedFile::getInstanceByName('file');
        $data = '';
        if($file){
            $model = new UserRequestAttachemnt();
            $model->request_id = $request_id;
            $model->fileFile = $file;
            $model->uploadFile();
            if(!$model->save()){
                throw new \yii\web\HttpException(200, "error saving file", 200);
            }

            $data = FillApiModelService::FillRequestFileApiModel($model);
        } else {
            throw new \yii\web\HttpException(200, "File not found", 200);
        }


        $res = new RequestFileResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);
        return $res;
    }



}
