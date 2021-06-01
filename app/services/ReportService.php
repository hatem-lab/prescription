<?php

namespace App\services;


use App\enums\ActiveInactiveStatus;
use App\enums\Constents;
use App\enums\ErrorCode;
use App\Models\Admin;
use App\Models\ItemReportReason;
use App\Models\API\other\ApiMessage;
use App\Models\API\reports\ReportReasonsResult;
use App\Models\ReportedItem;
use App\User;

class ReportService {

    public static function ReportReasonsList() {
        try {
            $query = ItemReportReason::where(['status' => ActiveInactiveStatus::active]);

            $data = [];
            foreach ($query->get() as $one) {
                $item = FillApiModelService::FillReportReasonApiModel($one);
                $data[] = $item;
            }

            $res = new ReportReasonsResult([
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
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }

    }

    public static function ReportItem($request) {

        try {
            $model = new ReportedItem();

            if (user()) {
                if($request->enum == "User")
                    return returnError("You Can't reported for another user");

                $admin = Admin::find($request->item_id);
                if(!$admin) return returnError("The selected item id is invalid");

                $model->creator_id = user()->id;
            }
            else if (admin()) {
                if($request->enum == "Delivery Guy")
                    return returnError("You Can not reported for another delivery guy");

                $user = User::find($request->item_id);
                if(!$user) return returnError("The selected item id is invalid");

                $model->creator_id = admin()->id;
            } else{
                return returnError("Unauthenticated.");
            }

            $model->create_date = date(Constents::full_date_format);
            $model->entity = $request->enum;
            $model->entity_id = $request->item_id;
            $model->reason_id = $request->reason_id;
            $model->text = $request->text;

            $model->save();
            return returnSuccess('Item reported successfully');

        }catch (\Exception $ex){
            return returnError(AdminService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }

    }


}
