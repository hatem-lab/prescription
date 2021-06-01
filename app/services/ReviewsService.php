<?php

namespace App\services;


use App\enums\ActiveInactiveStatus;
use App\enums\Constents;
use App\enums\ErrorCode;
use App\Http\Requests\ReviewDeleteRequest;
use App\Models\Admin;
use App\Models\API\other\ApiMessage;
use App\Models\API\reviews\ReviewsListResult;
use App\Models\Review;

class ReviewsService {


    public static function AddEditReview($request)
    {
        try {

            $model = Review::where(['user_id' => user()->id])
                ->where(['entity' => 'admin'])
                ->where(['entity_id' => $request->item_id])
                ->where('status', '!=' , ActiveInactiveStatus::deleted)
                ->first();

            if (!$model) {
                $model = new Review();
                $model->user_id = user()->id;
                $model->entity = 'admin';
                $model->entity_id = $request->item_id;
            }
            $model->create_date = date(Constents::full_date_format);
            $model->content = isset($request->text) ? $request->text : '';
            $model->rate = $request->rate;

            $model->save();
            return returnSuccess('Review saved.');

        } catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function DeleteReview($request)
    {
        try{
            $model = Review::find($request->review_id);

            if($model->user_id != user()->id){
               return returnError("review not yours to delete");
            }

            $model->delete();
            return returnSuccess('Review deleted.');

        } catch (\Exception $ex){
        return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function ReviewsList()
    {
        try {
            $query = Review::where(['entity' => 'admin'])
                    ->where(['entity_id' => admin()->id])
                    ->where(['status' => ActiveInactiveStatus::active]);


            $data = [];
            foreach ($query->get() as $one) {
                $item = FillApiModelService::FillReviewApiModel($one);
                $data[] = $item;
            }

            $res = new ReviewsListResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ]),
            ]);

            return [true, $res, '', ''];

        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }
    }

}
