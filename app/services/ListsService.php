<?php

namespace App\services;

use App\enums\ActiveInactiveStatus;
use App\enums\ErrorCode;
use App\enums\RequestStatus;
use App\Models\API\lists\CarTypeResult;
use App\Models\API\lists\OrderStatusListModel;
use App\Models\API\lists\OrderStatusListResult;
use App\Models\API\other\ApiMessage;
use App\Models\CarType;


class ListsService {


    public static function CarTypeList($request) {
        try {
            $query = CarType::where(['status' => ActiveInactiveStatus::active]);

            if ($request->car_type_id) {
                $query = $query->where(['id' => $request->car_type_id]);
            }


            $data = [];
            foreach ($query->get() as $one) {
                $item = FillApiModelService::FillCarTypeApiModel($one);
                $data[] = $item;
            }

            $res = new CarTypeResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ]),
            ]);

            return [true , $res , '' , ''];
        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }

    }


    public static function OrderStatusList(){

        try {
            $data = [];

            $data[] = FillApiModelService::FillOrderStatusApiModel(
                RequestStatus::new_request, RequestStatus::LabelOf(RequestStatus::new_request));
            $data[] = FillApiModelService::FillOrderStatusApiModel(
                RequestStatus::reserved, RequestStatus::LabelOf(RequestStatus::reserved));
            $data[] = FillApiModelService::FillOrderStatusApiModel(
                RequestStatus::on_way, RequestStatus::LabelOf(RequestStatus::on_way));
            $data[] = FillApiModelService::FillOrderStatusApiModel(
                RequestStatus::delivered, RequestStatus::LabelOf(RequestStatus::delivered));

            $res = new OrderStatusListResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ]),
            ]);

            return [true , $res , '' , ''];
        } catch (\Exception $ex){
            return [false , null , AdminService::Msg_Exception , $ex->getMessage()];
        }
    }


}
