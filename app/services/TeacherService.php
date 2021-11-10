<?php

namespace App\services;

use App\enums\ErrorCode;
use App\enums\LoginApiEnum;
use App\enums\UserConfirmationType;
use App\enums\UserStatus;
use App\Models\Admin;
use App\Models\AdminMobileEmail;
use App\Models\API\auth\LoginResult;
use App\Models\API\auth\LoginResultApi;
use App\Models\API\auth_admin\LoginAdminResult;
use App\Models\API\auth_admin\LoginAdminResultApi;
use App\Models\API\other\ApiMessage;
use App\Models\API\other\ApiResult;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\Region;
use App\Models\UserMobileEmail;
use App\User;
use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\NotificationType;
use common\enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


class TeacherService {

    const Msg_RegistrationSuccess = "Please Enter the Confirmation Code you will receive via SMS to confirm your moile number.";
    const Msg_Exception = "Something is wrong !!";

    public static function apiProfileCreate($request) {

        list($result, $user, $msg , $ex) = self::profileTeacherCreate($request);

        $data = FillApiModelService::FillApiResultRegisterResultModel($user, UserService::Msg_RegistrationSuccess);

        return [$result, $data, $msg , $ex];
    }

    public static function profileTeacherCreate($post) {

        $msg = [];
        $result = false;
        $model = null;
        $ex = '';

        try {
            $model = new Admin([
                'email' => $post->email,
                'name'=>$post->name,
                'password' => Hash::make($post->password),
                'user_type'=>'teacher',
            ]);
            $result = $model->save();
        } catch (\Exception $ex) {
            $ex = $ex->getMessage();
            $msg = TeacherService::Msg_Exception;
        }
        return [$result, $model, $result ? 'registered successfully' : $msg, $ex];
    }

    public static function TeacherProfileUpdate($request) {
        try {

                $model = user();
                if ($model) {
                    $model->name = (isset($request->name) && $request->name) ?
                        $request->name :
                        $model->name;
                    $model->region = (isset($request->region)) ? $request->region : $model->region;
                    $model->city = (isset($request->city)) ? $request->city : $model->city;
                    $model->phone = (isset($request->phone)) ? $request->phone : $model->phone;
                    $model->email = (isset($request->email)) ? $request->email : $model->email;
                    $model->password = (isset($request->password)) ? Hash::make($request->password) : $model->password;
                    if ($request->image) {
                        $model->photo = uploadImage($request->image, Admin::image_directory);
                    }
                    return (!$model->save()) ?
                        returnError("Error saving Teacher") :
                        returnSuccess("Teacher has been updated");

                } else return returnError("Teacher not found");
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }


    public static function addAdminMobileEmail($admin_id,$phone, $is_primary = 0) {

        try {
            $model = new AdminMobileEmail([
                'confirm_code' => rand(10000, 99999),
                'is_confirmed' => 0,
                'is_primary' => $is_primary,
                'type' => UserConfirmationType::account_confirm,
                'admin_id' => $admin_id,
                'mobile' => $phone,
            ]);

            $model->save();
            $model->sendConfirmationCodePhone(UserConfirmationType::account_confirm);
            return [true , ''];

        }catch (\Exception $ex){
            return [false , $ex->getMessage()];
        }
    }


    public static function loginPhoneEmailValidation($request) {
        try {
            $login_model = new LoginAdminResult();

            $token = Auth::guard('user-api')->attempt(['email' => $request->email , 'password' => $request->password,'user_type'=>'teacher']);
            $user = Auth::guard('user-api')->user();

            if (!$user) {
                return [false , null , LoginApiEnum::LabelOf(LoginApiEnum::not_found)
                    . " or " . LoginApiEnum::LabelOf(LoginApiEnum::invalid_password) , ''];
            }  else {
                $login_model->resultCode = LoginApiEnum::accepted;
                $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
                $login_model->token = $token;
                $login_model->profile = FillApiModelService::FillProfileAdminResultModel($user);
            }

            $result =  new LoginAdminResultApi([
                'result' => $login_model,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true , $result , '' , ''];

        }catch (\Exception $ex){
            return [false , null , TeacherService::Msg_Exception , $ex->getMessage()];
        }

    }

    public static function checkToken() {
        if (!\admin()) {
            return returnError(trans('Token expired'));
        }

        return returnSuccess(trans('Token Valid'));
    }

    public static function adminChangePhone($request) {
        $model = admin();
        try {
            $userMobile = AdminMobileEmail::where(['admin_id' => $model->id])
                                        ->where(['type' => UserConfirmationType::account_confirm])
                                        ->first();
            if(!$userMobile){
                $userMobile = new AdminMobileEmail([
                    'admin_id' => $model->id,
                    'type' => UserConfirmationType::account_confirm,
                    'is_primary' => 0,
                ]);
            }

            $userMobile->mobile = $request->newPhoneNumber;
            $userMobile->is_confirmed = 0;
            $userMobile->confirm_code = rand(10000, 99999);
            if(!$userMobile->save()) {
                return [false , null , "Error saving phone" , ''];
            }

            $model->status = UserStatus::STATUS_INACTIVE;
            $model->mobile_confirmed = 0;
            $model->phone = $request->newPhoneNumber;
            $model->save();
            $data = new ApiResult([
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => trans('Phone number is changed'),
                ]),
            ]);
            return [true , $data , '' , ''];

        }catch (\Exception $ex){
            return [false , null , TeacherService::Msg_Exception , $ex->getMessage()];
        }
    }


    public static function apiLogOut(Request $request) {
        try{
            $token = Str::after($request->header('Authorization') , 'Bearer ');
            JWTAuth::setToken($token)->invalidate();
            return returnSuccess("Logged out successfully");
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage());
        }
    }

    public static function confirmAdminPhone($request, $type = UserConfirmationType::account_confirm) {

        try {
            $model = AdminMobileEmail::where(['mobile' => $request->phone])
                ->where(['type' => $type])
                ->first();

            if ($model->is_confirmed) {
                return [false, null, "Mobile already confirmed" , ''];
            }
            if ($model->confirm_code != $request->code) {
                return [false, null, "Wrong confirmation code" , ''];
            } else {
                $user = Admin::where('id', $model->admin_id)->first();

                if (!$user) {
                    return [false, null, "Admin not found" , ''];
                }
                $model->is_confirmed = 1;
                if (!$model->save()) {
                    return [false, null, "Error saving email" , ''];
                }
                $user->mobile_confirmed = 1;
                $user->status = UserStatus::STATUS_ACTIVE;
                if (!$user->save()) {
                    return [false, null, "Error saving user" , ''];
                }

                //delete other phones
                $models = AdminMobileEmaiL::where(['admin_id' => $model->admin_id])
                    ->where('mobile', 'not' , $request->phone)
                    ->where(['type' => $type])
                    ->get();

                foreach ($models as $one) {
                    $one->delete();
                }

                $login_model = new LoginAdminResult();
                $login_model->resultCode = LoginApiEnum::accepted;
                $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
                $login_model->profile = FillApiModelService::FillProfileAdminResultModel($user);
                $res = new LoginAdminResultApi([
                    'result' => $login_model,
                    'isOk' => true,
                    'message' => new ApiMessage([
                        'type' => 'Success',
                        'code' => ErrorCode::success,
                        'content' => '',
                    ])
                ]);
            }
            return [true , $res , '' , ''];
        }catch (\Exception $ex){
            return [false , null , TeacherService::Msg_Exception ,$ex->getMessage()];
        }
    }


    public static function resendCode($request) {

        try {
            $model = AdminMobileEmail::where(['mobile' => $request->phone])
                ->where(['type' => UserConfirmationType::account_confirm])
                ->where(['is_confirmed' => 0])
                ->first();

            if ($model) {
                $model->confirm_code = rand(10000, 99999);
                if (!$model->save()) {
                    return returnError("Error saving code");

                }
            } else {
                return returnError("User is already activated");
            }

            return returnSuccess('Code Resent');
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage());
        }
    }

    public static function deleteAccount($request) {

        try{
            $model = admin();
            if ($request->phone != $model->phone) {
                returnError("Wrong phone");
            }

            if($model){
                $token = Str::after($request->header('Authorization') , 'Bearer ');
                JWTAuth::setToken($token)->invalidate();
                $model->delete();
            } else {
                returnError("Admin not found");
            }
            return returnSuccess("Deleted");

        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage());
        }
    }


    public static function AdminForgetPassword($request) {

        try {
            $admin = Admin::where(['phone' => $request->phone])->first();


            if (!$admin) {
                return returnError("Admin not found");
            }

            $model = AdminMobileEmail::where(['mobile' => $request->phone])
                ->where(['type' => UserConfirmationType::forgot_password])
                ->where(['is_confirmed' => 0])
                ->first();


            if (!$model) {
                $model = new AdminMobileEmail([
                    'confirm_code' => rand(10000, 99999),
                    'is_confirmed' => 0,
                    'is_primary' => 0,
                    'admin_id' => $admin->id,
                    'mobile' => $request->phone,
                    'type' => UserConfirmationType::forgot_password
                ]);
                $model->save();
            }

            //send code
            $msg = UserService::Msg_RegistrationSuccessForgetPasswordPhone;
            $model->sendConfirmationCodePhone(UserConfirmationType::forgot_password);

            return returnSuccess($msg);
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage());
        }
    }

    public static function AdminForgetPasswordConfirm($request) {

        try {
            $admin = Admin::where(['phone' => $request->phone])
                ->where(['status' => UserStatus::STATUS_ACTIVE])
                ->first();

            if (!$admin) {
                return returnError("Admin not found");
            }

            $model = AdminMobileEmail::where(['mobile' => $request->phone])
                ->where(['type' => UserConfirmationType::forgot_password])
                ->where(['is_confirmed' => 0])
                ->first();

            if (!$model) {
                return returnError("Forget password request not found!");
            }

            if ($model->confirm_code != $request->code) {
                return returnError("Wrong confirmation code");

            } else {
                $model->is_confirmed = 1;
                if (!$model->save()) {
                    return returnError("Error saving phone");
                }

                //change password
                $admin->password = bcrypt($request->newPassword);
                if (!$admin->save()) {
                    return returnError("Error saving phone");
                }
            }
            return returnSuccess('Password Changed');
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function addCarImage($request){
        try {
            $model = new CarImage();
            if ($model) {
                $model->image = uploadImage($request->image, CarImage::image_directory);
                $model->admin_id = admin()->id;
                if (!$model->save()) {
                    return returnError("Error saving user");
                }
                return returnSuccess("Your Car Image Added");
            } else {
                return returnError("Admin not found");
            }

        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage());
        }
    }

    public static function deleteCarImage($request) {

        try{

            $carImage = CarImage::where('id' , $request->car_image_id)
                ->where('admin_id' , admin()->id)->first();


            if(!$carImage) {
                return returnError("This id of image is not found");
            }

            $carImage->delete();

            return returnSuccess("Deleted");

        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }


}
