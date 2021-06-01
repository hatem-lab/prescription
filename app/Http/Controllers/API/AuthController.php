<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePhoneRequest;
use App\Http\Requests\Auth\LocationRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Models\API\auth\RegisterResult;
use App\services\FillApiModelService;
use App\services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


/**
 * Class AuthController
 */

class AuthController extends Controller
{

    /**
     * @OA\Post(path="/register",
     *     tags={"Auth"},
     *     summary="Register as a new user",
     *     operationId="authRegister",
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Registration model",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterModel")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RegisterResult response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResultRegisterResult"),
     *     ),
     * )
     * @param RegisterRequest $request
     * @return string
     */

    public function register(RegisterRequest $request)
    {
        list($res, $data, $msg , $ex) = UserService::apiProfileCreate($request);

        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Post(path="/login",
     *     tags={"Auth"},
     *     summary="Login as a user",
     *     operationId="authLogin",
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Login model",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginPayload")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "User Profile response",
     *         @OA\JsonContent(ref="#/components/schemas/LoginResultApi"),
     *     ),
     * )
     * @param LoginRequest $request
     * @return JsonResponse
     */

    public function login(LoginRequest $request)
    {
        list($res, $data, $msg , $ex) = UserService::loginPhoneEmailValidation($request);

        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Post(path="/change-phone-number",
     *     tags={"Auth"},
     *     summary="Change phone Number",
     *     operationId="authChangePhone",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="ChangePhoneNumberKernelModel model",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ChangePhoneNumberKernelModel")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     * @param ChangePhoneRequest $request
     * @return JsonResponse
     */

    public function change_phone_number(ChangePhoneRequest $request)
    {
        list($res, $data, $msg , $ex) = UserService::userChangePhone($request);

        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Post(path="/logout",
     *     tags={"Auth"},
     *     summary="Log out from system",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     * @param $request
     * @return JsonResponse
     */
    public function logout(Request $request)
    {
        return UserService::apiLogOut($request);
    }


    /**
     * @OA\Post(path="/verify-account",
     *     tags={"Auth"},
     *     summary="Verify account with changing its status to active",
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="ConfirmAccountModel model",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ConfirmAccountModel")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "User Profile response",
     *         @OA\JsonContent(ref="#/components/schemas/LoginResultApi"),
     *     ),
     * )
     * @param VerifyAccountRequest $request
     * @return JsonResponse
     */

    public function verify_account(VerifyAccountRequest $request)
    {
        list($res, $data, $msg , $ex) = UserService::confirmUserPhone($request);

        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Post(path="/resend-code",
     *     tags={"Auth"},
     *     summary="Resend the code if not received",
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         description="phone of user",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     * @param LoginRequest $request
     * @return JsonResponse
     */

    public function resend_code(LoginRequest $request)
    {
        return UserService::resendCode($request);
    }


    /**
     * @OA\Get(path="/profile",
     *     tags={"Auth"},
     *     summary="Get profile details",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "ApiResultProfileResult response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResultProfileResult"),
     *     ),
     * )
     */

    public function profile()
    {
        $data = FillApiModelService::FillProfileResultModel(user());
        $data = FillApiModelService::FillApiResultProfileResult($data);
        return response()->json($data);
    }

    /**
     * @OA\Post(path="/update-profile",
     *     tags={"Auth"},
     *     summary="Edit profile content",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *              @OA\Schema(ref="#components/schemas/EditProfileRequest"),
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "ApiResultProfileResult response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     * @param Request $request
     * @return JsonResponse
     */

    public function update_profile(Request $request)
    {
        return UserService::userProfileUpdate($request);
    }


    /**
     * @OA\Post(path="/delete-account",
     *     tags={"Auth"},
     *     summary="Delete as a user",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="LoginPayload model",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginPayload")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     * @param LoginRequest $request
     * @return JsonResponse
     */

    public function delete_account(LoginRequest $request)
    {
        return UserService::deleteAccount($request);
    }

    /**
     * @OA\Get(path="/check-token",
     *     tags={"Auth"},
     *     summary="Test a token for expiration",
     *     security={{"apiAuth":{}}},
     *     @OA\Parameter(
     *         name="Language",
     *         in="header",
     *         description="(en or ar) If left empty it is English",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResult"),
     *     ),
     * )
     */

    public function check_token()
    {
        return UserService::checkToken();
    }




}
