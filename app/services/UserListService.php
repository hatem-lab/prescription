<?php

namespace common\services;

use api\models\bids\BundlesResult;
use api\models\other\ApiMessage;
use api\models\paths\PathsResult;
use api\models\subject\SubjectsListResult;
use api\models\subject\TopicsListResult;
use common\enums\ActiveInactiveStatus;
use common\enums\AddRemoveEnum;
use common\enums\Constents;
use common\enums\ErrorCode;
use common\enums\PublishStatus;
use common\enums\TopicTypeEnum;
use common\interfaces\IUserListInterface;
use common\models\Bundle;
use common\models\Favorite;
use common\models\Path;
use common\models\Subject;
use common\models\Topic;
use common\models\UserList;
use common\models\UserRequest;
use common\models\UserSubscription;
use yii\data\ActiveDataProvider;

class UserListService {

    public static function AddOrRemoveListItem($request, $add_or_remove, $entity) {
        if(!in_array($entity, ["product", "news", "bid"])){
            throw new \yii\web\HttpException(200, "entity not valid", 200);
        }

        $model = Favorite::find()
            ->andWhere(['entity' => $entity])
            ->andWhere(['entity_id' => $request->entity_id])
            ->andWhere(['user_id' => userId()])
            ->one();
        if($add_or_remove == AddRemoveEnum::add){
            if($model){
                throw new \yii\web\HttpException(200, "Already in list!", 200);
            }
            $model = new Favorite();
            $model->entity = $entity;
            $model->entity_id = $request->entity_id;
            $model->user_id = userId();
            $model->create_date = date(Constents::full_date_format);
            if(!$model->save()){
                stopv($model->errors);
                throw new \yii\web\HttpException(200, "Error saving list", 200);
            }

            $res = api_success_msg("Added to list");
        } else {
            if(!$model){
                throw new \yii\web\HttpException(200, "Already removed from list!", 200);
            }
            $model->delete();
            $res = api_success_msg("Removed from list");
        }

        return $res;
    }

    public static function requests($pagesize = 20, $page = 0, $type = '') {
        $query = UserRequest::find()
            ->andWhere(['user_id' => userId()])
        ;

        if($type && $type != '{type}' && $type != ','){
            $query = $query->andWhere(['request_type' => $type]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['create_date' => SORT_DESC]],
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);

        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillRequestDetailsApiModel($one);
            $data[] = $item;
        }

        if(!$pagesize){
            $pagesize = 20;
        }
        $res = new BundlesResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ]),
            'pagesCount' => ($dataProvider->getTotalCount()>$pagesize) ? (int)($dataProvider->getTotalCount()/$pagesize) : 1,
        ]);

        return $res;
    }

    public static function subscriptions($pagesize = 20, $page = 0) {
        $query = UserSubscription::find()
            ->andWhere(['user_id' => userId()])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['create_date' => SORT_DESC]],
            'pagination' => [
                'pagesize' => (isset($pagesize) ? $pagesize :  20),
                'page' => (isset($page) ? $page :  0),
            ],
        ]);

        $data = [];
        foreach ($dataProvider->getModels() as $one){
            $item = FillApiModelService::FillSubscriptionDetailsApiModel($one);
            $data[] = $item;
        }

        if(!$pagesize){
            $pagesize = 20;
        }
        $res = new BundlesResult([
            'result' => $data,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ]),
            'pagesCount' => ($dataProvider->getTotalCount()>$pagesize) ? (int)($dataProvider->getTotalCount()/$pagesize) : 1,
        ]);

        return $res;
    }

}
