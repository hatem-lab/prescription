<?php

namespace App\Http\Controllers\API;

use App\services\ListsService;
use App\Http\Requests\OfferRequest;
use App\services\RequestsService;
use Illuminate\Http\Request;

/**
 * Class ServicesController
 */
class ServicesController
{

    public function prescriptions_details(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::PrescriptionDetails($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Get(path="/services/course-details",
     *     tags={"services teachers"},
     *     summary="course details",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of course",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "CourseResult response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseResult"),
     *     ),
     * )
     */

    public function course_details(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::CourseDetails($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Get(path="/services/all-courses",
     *     tags={"services teachers"},

     *     summary="all courses",
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
     *         name="pagesize",
     *         in="query",
     *         description="number of retuned values",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseResult"),
     *     ),
     * )
     */

    public function all_courses(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::AllCourses($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }




    /**
     * @OA\Post(path="/services/create-course",
     *     tags={"services teachers"},
     *     summary="Create New course",
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
     *              @OA\Schema(ref="#components/schemas/CreateCousePayLoad"),
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseResult"),
     *     ),
     * )
     */

    public function create_course(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::CreateCourse($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Post(path="/services/update-course",
     *     tags={"services teachers"},
     *     summary="Create New course",
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
     *              @OA\Schema(ref="#components/schemas/UpdateCoursePayLoad"),
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseResult"),
     *     ),
     * )
     */

    public function update_course(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::UpdateCourse($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Post(path="/services/delete-course",
     *     tags={"services teachers"},
     *     summary="delete course",
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
     *         @OA\JsonContent(ref="#/components/schemas/DeleteCoursePayload")
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

    public function delete_course(Request $request)
    {
        return RequestsService::deleteCourse($request);
    }


    /**
     * @OA\Get(path="/services/courses-student",
     *     tags={"services Student"},
     *     security={{"apiAuth":{}}},
     *     summary="student courses",
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
     *         name="pagesize",
     *         in="query",
     *         description="number of retuned values",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseResult"),
     *     ),
     * )
     */

    public function courses_student(Request $request)
    {
        if(student()=='student')
        {
            list($res, $data, $msg , $ex) =  RequestsService::CoursesStudent($request);
            if($res){
                return response()->json($data);
            } else {
                return returnError($msg , $ex);
            }
        }else{
            return returnError('must be authenticated');
        }

    }

}
