<?php

namespace App\services;

use App\enums\ErrorCode;
use App\enums\LoginApiEnum;
use App\enums\UserStatus;
use App\Models\Admin;
use App\Models\API\auth\LoginResult;
use App\Models\API\auth\LoginResultApi;
use App\Models\API\location\LocationUserResult;
use App\Models\API\other\ApiMessage;
use App\Models\API\other\ApiResult;
use App\Models\Location;
use App\Models\Region;
use App\User;
use App\enums\UserConfirmationType;
use App\Models\UserMobileEmail;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{

    const Msg_RegistrationSuccess = "Please Enter the Confirmation Code you will receive via email to confirm your account.";
    const Msg_RegistrationSuccessForgetPassword = "Please Enter the Confirmation Code you will receive via Email to confirm changing your password.";
    const Msg_RegistrationSuccessForgetPasswordPhone = "Please Enter the Confirmation Code you will receive via SMS to confirm changing your password.";
    const facebook_graph_base_url = 'https://graph.facebook.com/';

    public static function profileCreate($post)
    {
        $msg = [];
        $result = false;
        $model = null;
        $ex = '';
        try {
            $model = new Admin([
                'email' => $post->email,
                'name'=>$post->name,
                'password' => Hash::make($post->password),
                'user_type'=>'student',
            ]);
            $result = $model->save();
        } catch (\Exception $ex) {
            $ex = $ex->getMessage();
            $msg = TeacherService::Msg_Exception;
        }
        return [$result, $model, $result ? 'regestered sucussefuly' : $msg, $ex];
    }

    public static function apiProfileCreate($request)
    {

        list($result, $user, $msg, $ex) = self::profileCreate($request);

        $data = FillApiModelService::FillApiResultRegisterResultModel($user, UserService::Msg_RegistrationSuccess);

        return [$result, $data, $msg, $ex];
    }

    public static function profileUpdate($request)
    {
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
                returnSuccess("Student has been updated");

        } else return returnError("Student not found");
       }catch (\Exception $ex){
        return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
            }

    public static function login($request)
    {
        try {
            $login_model = new LoginResult();


            $token = Auth::guard('user-api')->attempt(['email' => $request->email, 'password' =>  $request->password,'user_type'=>'student']);
            $user = Auth::guard('user-api')->user();


            if (!$user) {
                $login_model->resultCode = LoginApiEnum::not_found;
                $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
            }  else {
                $login_model->resultCode = LoginApiEnum::accepted;
                $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
                $login_model->token = $token;
                $login_model->profile = FillApiModelService::FillProfileResultModel($user);
            }

            $result = new LoginResultApi([
                'result' => $login_model,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);

            return [true, $result, '', ''];

        } catch (\Exception $ex) {
            return [false, null, TeacherService::Msg_Exception, $ex->getMessage()];
        }

    }


    public static function addUserMobileEmail($user_id, $phone, $is_primary = 0)
    {

        try {
            $model = new UserMobileEmail([
                'confirm_code' => rand(10000, 99999),
                'is_confirmed' => 0,
                'is_primary' => $is_primary,
                'type' => UserConfirmationType::account_confirm,
                'user_id' => $user_id,
                'mobile' => $phone,
            ]);

            $model->save();
            $model->sendConfirmationCodePhone(UserConfirmationType::account_confirm);
            return [true, ''];

        } catch (\Exception $ex) {
            return [false, $ex->getMessage()];
        }
    }


    public static function addUserAddress($user_id, $type = 1, $title = '', $first_name = '', $last_name = '', $address_1 = '', $address_2 = '',
                                          $block = '', $floor = '', $door_number = '', $phone = '')
    {
        $model = UserAddress::find()
            ->andWhere(['user_id' => $user_id])
            ->andWhere(['type' => $type])
            ->one();
        if (!$model) {
            $model = new UserAddress();
            $model->user_id = $user_id;
            $model->type = $type;
            $model->title = $title;
            $model->first_name = $first_name;
            $model->last_name = $last_name;
            $model->address_1 = $address_1;
            $model->address_2 = $address_2;
            $model->block = $block;
            $model->floor = $floor;
            $model->door_number = $door_number;
            $model->phone = $phone;

            if (!$model->save()) {
                stopv($model->errors);
            }
        }
        return true;
    }

    public static function confirmUserEmail($email, $code, $type = UserConfirmationType::email_confirm)
    {
        $model = UserMobileEmail::find()
            ->andWhere(['email' => $email])
            ->andWhere(['type' => $type])
            ->one();
        $res = '';
        if (!$model) {
            throw new \yii\web\HttpException(200, "Email not found", 200);
        }
        if ($model->is_confirmed) {
            throw new \yii\web\HttpException(200, "Email already confirmed", 200);
        }
        if ($model->confirm_code != $code) {
            throw new \yii\web\HttpException(200, "Wrong confirmation code", 200);
        } else {
            $user = User::findOne($model->user_id);
            if (!$user) {
                throw new \yii\web\HttpException(200, "User not found", 200);
            }
            $model->is_confirmed = 1;
            if (!$model->save()) {
                throw new \yii\web\HttpException(200, "Error saving email", 200);
            }
            $user->email = $model->email;
            $user->email_confirmed = 1;
            $user->status = User::STATUS_ACTIVE;
            if (!$user->save()) {
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            }

            //delete other emails
            $models = UserMobileEmail::find()
                ->andWhere(['user_id' => $model->user_id])
                ->andWhere(['not', ['email' => $email]])
                ->andWhere(['type' => $type])
                ->all();
            foreach ($models as $one) {
                $one->delete();
            }

            //
            $login_model = new LoginResult();
            $user->setAuthKey;
            $is_ok = true;
            $login_model->resultCode = LoginApiEnum::accepted;
            $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
            $login_model->token = $user->auth_key;
            $login_model->profile = FillApiModelService::FillProfileResultModel($user);
            $res = new LoginResultApi([
                'result' => $login_model,
                'isOk' => $is_ok,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);
        }
        return $res;
    }


    public static function confirmUserPhone($request, $type = UserConfirmationType::account_confirm)
    {

        try {
            $model = UserMobileEmail::where(['mobile' => $request->phone])
                ->where(['type' => $type])
                ->first();

            if ($model->is_confirmed) {
                return [false, null, "Mobile already confirmed", ''];
            }
            if ($model->confirm_code != $request->code) {
                return [false, null, "Wrong confirmation code", ''];
            } else {
                $user = User::where('id', $model->user_id)->first();

                if (!$user) {
                    return [false, null, "User not found", ''];
                }
                $model->is_confirmed = 1;
                if (!$model->save()) {
                    return [false, null, "Error saving email", ''];
                }
                $user->mobile_confirmed = 1;
                $user->status = UserStatus::STATUS_ACTIVE;
                if (!$user->save()) {
                    return [false, null, "Error saving user", ''];
                }

                //delete other phones
                $models = UserMobileEmaiL::where(['user_id' => $model->user_id])
                    ->where('mobile', 'not', $request->phone)
                    ->where(['type' => $type])
                    ->get();

                foreach ($models as $one) {
                    $one->delete();
                }

                $login_model = new LoginResult();
                $login_model->resultCode = LoginApiEnum::accepted;
                $login_model->resultText = LoginApiEnum::LabelOf($login_model->resultCode);
                $login_model->token = Auth::guard('user-api')->attempt(['phone' => $request->phone, 'password' => null]);
                $login_model->profile = FillApiModelService::FillProfileResultModel($user);
                $res = new LoginResultApi([
                    'result' => $login_model,
                    'isOk' => true,
                    'message' => new ApiMessage([
                        'type' => 'Success',
                        'code' => ErrorCode::success,
                        'content' => '',
                    ])
                ]);
            }
            return [true, $res, '', ''];
        } catch (\Exception $ex) {
            return [false, null, TeacherService::Msg_Exception, $ex->getMessage()];
        }
    }

    public static function userChangePhone($request)
    {
        $model = user();
        try {

            $userMobile = UserMobileEmail::where(['user_id' => $model->id])
                ->where(['type' => UserConfirmationType::account_confirm])
                ->first();
            if (!$userMobile) {
                $userMobile = new UserMobileEmail([
                    'user_id' => $model->id,
                    'type' => UserConfirmationType::account_confirm,
                    'is_primary' => 0,
                ]);
            }

            $userMobile->mobile = $request->newPhoneNumber;
            $userMobile->is_confirmed = 0;
            $userMobile->confirm_code = rand(10000, 99999);
            if (!$userMobile->save()) {
                return [false, null, "Error saving phone", ''];
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
            return [true, $data, '', ''];

        } catch (\Exception $ex) {
            return [false, null, TeacherService::Msg_Exception, $ex->getMessage()];
        }
    }


    public static function userSetProfileData($request)
    {
        $model = user();
        $data = [];
        if ($model) {
//            if (!$model->need_password && !Yii::$app->security->validatePassword($request->password, $model->password_hash)) {
//                throw new \yii\web\HttpException(200, "Wrong password", 200);
//            }

            $userModel = User::findOne($model->id);
            if (isset($request->phone)) {
                if (!$userModel->phone) {
                    //find phone
                    $user = User::find()
                        ->andWhere(['phone' => $request->phone])
                        ->one();
                    if ($user) {
                        throw new \yii\web\HttpException(200, "Phone already used", 200);
                    }
                    $userModel->phone = $request->phone;
                    $userModel->mobile_confirmed = 0;
                    list($result_mobile, $model_mobile) = UserService::addUserMobileEmail($userModel->id, ["UserMobileEmail" => ["mobile" => $userModel->phone]], 1, true);
                } else {
                    throw new \yii\web\HttpException(200, "Phone already set", 200);
                }
            }
            if (isset($request->new_password)) {
                if ($userModel->need_password) {
                    $userModel->password_hash = self::setPassword($request->new_password);
                    $userModel->need_password = 0;
                } else {
                    throw new \yii\web\HttpException(200, "Password already set", 200);
                }
            }

//            Yii::$app->user->logout();
//            UserService::reflectProfileUpdateOnTeacher($model);
            if (!$userModel->save()) {
                throw new \yii\web\HttpException(200, "Error saving user", 200);
            }
            $data = new ApiResult([
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => t('Saved', [], api_lang()),
//                    'content' => t(UserService::Msg_RegistrationSuccess, [], api_lang()),
                ]),
            ]);
        } else {
            throw new \yii\web\HttpException(200, "User not found", 200);
        }
        return $data;
    }


    public static function sendCodePhone($model)
    {
        $phone = $model->mobile;
        $code = $model->confirm_code;
        //add sms code

        return true;
    }

    public static function sendCodeEmail(UserMobileEmail $model, $type = UserConfirmationType::email_confirm)
    {
        //add email code
        $model->sendConfirmationCodeEmail($type);
        return true;
    }


    public static function apiLogOut(Request $request)
    {
        try {
            $token = Str::after($request->header('Authorization'), 'Bearer ');
            JWTAuth::setToken($token)->invalidate();
            return returnSuccess("Logged out successfully");
        } catch (\Exception $ex) {
            return returnError(TeacherService::Msg_Exception, $ex->getMessage(), $ex->getCode());
        }
    }

    public static function resendCode($request)
    {

        try {
            $model = UserMobileEmail::where(['mobile' => $request->phone])
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
        } catch (\Exception $ex) {
            return returnError(TeacherService::Msg_Exception, $ex->getMessage());
        }
    }

    public static function userProfileUpdate($request)
    {
        try {
            $model = user();
            if ($model) {
                $model->fname = (isset($request->first_name) && $request->first_name) ? $request->first_name : $model->fname;
                $model->lname = (isset($request->last_name) && $request->last_name) ? $request->last_name : $model->lname;

                if ($request->image) {
                    $model->avatar = uploadImage($request->image, User::image_directory);
                }

                return (!$model->save()) ? returnError("Error saving user") : returnSuccess("User has been updated");
            } else {
                return returnError("User not found");
            }

        } catch (\Exception $ex) {
            return returnError(TeacherService::Msg_Exception, $ex->getMessage(), 555);
        }
    }


    public static function deleteAccount($request)
    {

        try {
            $model = user();
            if ($request->phone != $model->phone) {
                returnError("Wrong phone");
            }

            if ($model) {
                $token = Str::after($request->header('Authorization'), 'Bearer ');
                JWTAuth::setToken($token)->invalidate();
                $model->delete();
            } else {
                returnError("User not found");
            }
            return returnSuccess("Deleted");

        } catch (\Exception $ex) {
            return returnError(TeacherService::Msg_Exception, $ex->getMessage(), $ex->getCode());
        }
    }

    public static function checkToken()
    {
        if (!\user()) {
            return returnError(trans('Token expired'));
        }

        return returnSuccess(trans('Token Valid'));
    }

    public static function getLocation()
    {
        try {

            $data = FillApiModelService::FillLocationApiModel(user()->id);
            $res = new LocationUserResult([
                'result' => $data,
                'isOk' => true,
                'message' => new ApiMessage([
                    'type' => 'Success',
                    'code' => ErrorCode::success,
                    'content' => '',
                ])
            ]);
            return [true, $res, '', ''];
        } catch (\Exception $ex){
            return [false, null, TeacherService::Msg_Exception, $ex->getMessage()];
        }
    }

    public static function addLocation($request) {
        try {

            if($request->region_id){
                $region = Region::where('id' , $request->region_id)->first();
                if(!$region) return returnError("The selected region id is invalid");
            }

            $location = new Location([
                'user_id' => user()->id,
                'address' => $request->address,
                'region_id' => $request->region_id,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'status' => $request->status
            ]);

            $location->save();
            return returnSuccess("A new location has been added");
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function updateLocation($request) {
        try {

            if($request->region_id){
                $region = Region::where('id' , $request->region_id)->first();
                if(!$region) return returnError("The selected region id is invalid");
            }

            $location = Location::where('id' , $request->location_id)
                                ->where('user_id' , user()->id)->first();

            if(!$location){
                return returnError("This Location is not found");
            }

            $location->update([
                'region_id' => isset($request->region_id) ? $request->region_id : $location->region_id,
                'address' => isset($request->address) ? $request->address : $location->address,
                'lat' => isset($request->lat) ? $request->lat : $location->lat,
                'lng' => isset($request->lng) ? $request->lng : $location->lng,
                'status' => isset($request->status) ? $request->status : $location->status,
            ]);


            return returnSuccess("This location has been updated");
        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function deleteLocation($request) {

        try{

            $location = Location::where('id' , $request->location_id)
                ->where('user_id' , user()->id)->first();

            if(!$location) {
                return returnError("This Location is not found");
            }

            $location->delete();

            return returnSuccess("Deleted");

        }catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function changeFirebaseToken($request) {
        try{
            if(user()) $user = user();
            else if(admin()) $user = admin();
            else returnError('Unauthenticated');

            if(!$user){
                return returnError('User not found');
            }
            $user->firebase_token = $request->newToken;
            $user->save();
            return returnSuccess('Firebase token changed');
        } catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }
    }

    public static function changeApplicationLanguage($request)
    {
        try{
            if(user()) $user = user();
            else if(admin()) $user = admin();
            else returnError('Unauthenticated');

            if(!$user) return returnError('User not found');

            $user->language = $request->language ? $request->language : 'en';
            $user->save();
            return returnSuccess('User language changed');
        } catch (\Exception $ex){
            return returnError(TeacherService::Msg_Exception , $ex->getMessage() , $ex->getCode());
        }


    }
}
