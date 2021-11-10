<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangeAdminPhoneRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ChangePhoneRequest;
use App\Http\Requests\Auth\ForgetPasswordConfirmRequest;
use App\Http\Requests\Auth\LoginAdminRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\Auth\RegisterAdminRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResendCodeAdminRequest;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Http\Requests\Auth\VerifyAdminAccountRequest;
use App\Models\Admin;
use App\Models\API\auth\ForgetPasswordConfirm;
use App\Models\API\auth\RegisterResult;
use App\Models\API\auth_admin\ProfileAdminResult;
use App\services\FillApiModelService;
use App\services\TeacherService;
use App\services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthTeacherController extends Controller
{
    /**
     * Class AuthController
     */




    /**
     * @OA\Post(path="/teacher/register",
     *     tags={"Auth Teacher"},
     *     summary="Register as a new Teacher",
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

        list($res, $data, $msg , $ex) = TeacherService::apiProfileCreate($request);

        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }






    /**
     * @OA\Post(path="/teacher/login",
     *     tags={"Auth Teacher"},
     *     summary="Login as a Teacher",
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
     *         @OA\JsonContent(ref="#/components/schemas/LoginAdminPayload")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "User Profile response",
     *         @OA\JsonContent(ref="#/components/schemas/LoginAdminResultApi"),
     *     ),
     * )
     * @param LoginAdminRequest $request
     * @return JsonResponse
     */

    public function login(Request $request)
    {
//        if($user=Admin::where('email',$request->email)->first())
//        {
//            if(! Hash::check($request->password, $user->password))
//            {
//                $message='this password not found';
//                $message = is_array($message) ? implode($message) : $message;
//                return returnError($message ,'');
//            }
//        }
        list($res, $data, $msg, $ex) = TeacherService::loginPhoneEmailValidation($request);

        if ($res) {
            return response()->json($data);
        } else {
            return returnError($msg, $ex);
        }
    }







    /**
     * @OA\Get(path="/teacher/profile",
     *     tags={"Auth Teacher"},
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
     *         @OA\JsonContent(ref="#/components/schemas/ApiResultProfileAdminResult"),
     *     ),
     * )
     */

    public function profile()
    {
        if(teacher()=="teacher")
        {
            $data = FillApiModelService::FillProfileAdminResultModel(user());
            $data = FillApiModelService::FillApiResultProfileAdminResult($data);
            return response()->json($data);
        }
        else
        {
          return  returnError('must be authenticated');
        }

    }

    /**
     * @OA\Post(path="/teacher/update-profile",
     *     tags={"Auth Teacher"},
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
     *              @OA\Schema(ref="#components/schemas/EditProfileAdminRequest"),
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
        if(teacher()=="teacher")
        {
         return TeacherService::TeacherProfileUpdate($request);
        }
        else
        {
            return  returnError('must be authenticated');
        }
    }

    /**
     * @OA\Post(path="/teacher/logout",
     *     tags={"Auth Teacher"},
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
        return TeacherService::apiLogOut($request);
    }









}
