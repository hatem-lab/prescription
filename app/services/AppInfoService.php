<?php

namespace App\services;


use App\enums\ErrorCode;
use App\Models\AboutApp;
use App\Models\API\app_info\AboutAppResult;
use App\Models\ContactUs;
use App\Models\API\app_info\ContactUsResult;
use App\Models\API\other\ApiMessage;

class AppInfoService {

    public static function ContactUs() {
        try{
            $model = ContactUs::get()->first();

            if(!$model){
                return [false , null , "There is no information available" , ''];
            }

            $data = FillApiModelService::FillContactUsApiModel($model);

            $res = new ContactUsResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true, $res, '', ''];
        } catch (\Exception $ex) {
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }
    }

    public static function AboutApp() {
        try{
            $model = AboutApp::get()->first();

            if(!$model){
                return [false , null , "There is no information available" , ''];
            }

            $data = FillApiModelService::FillAboutAppApiModel($model);

            $res = new AboutAppResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true, $res, '', ''];
        } catch (\Exception $ex) {
            return [false, null, AdminService::Msg_Exception, $ex->getMessage()];
        }
    }



}
