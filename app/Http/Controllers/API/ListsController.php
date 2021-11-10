<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\services\ListsService;

use Illuminate\Http\Request;
use App\Models\Property;
/**
 * Class ListsController
 */
class ListsController
{

    /**
     * @OA\Get(path="/lists/Courses-Type",
     *     tags={"Lists"},
     *     summary="Courses Type List",
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
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search by type",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/CourseTypeResult"),
     *     ),
     * )
     */
    public function courses_type(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::CourseTypeList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Get(path="/lists/Teachers",
     *     tags={"Lists"},
     *     summary="Teachers List",
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
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search by name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/TeachersResult"),
     *     ),
     * )
     */
    public function Teachers(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::TeachersList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }






}
