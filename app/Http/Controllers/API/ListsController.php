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
     * @OA\Get(path="/lists/categories",
     *     tags={"Lists"},
     *     summary="categories List",
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
     *         @OA\JsonContent(ref="#/components/schemas/CategoryResult"),
     *     ),
     * )
     */
    public function categories(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::CategoriesList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Get(path="/lists/companies",
     *     tags={"Lists"},
     *     summary="companies List",
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
     *         @OA\JsonContent(ref="#/components/schemas/CompanyResult"),
     *     ),
     * )
     */
    public function companies(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::CompaniesList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }



    /**
 * @OA\Get(path="/lists/contraindications",
 *     tags={"Lists"},
 *     summary="contraindications List",
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
 *         @OA\JsonContent(ref="#/components/schemas/ContraindicationsResult"),
 *     ),
 * )
 */
    public function contraindications(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::ContraindicationsList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Get(path="/lists/shapes",
     *     tags={"Lists"},
     *     summary="shapes List",
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
     *         @OA\JsonContent(ref="#/components/schemas/ContraindicationsResult"),
     *     ),
     * )
     */
    public function shapes(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::ShapesList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }



    /**
     * @OA\Get(path="/lists/doses",
     *     tags={"Lists"},
     *     summary="doses List",
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
     *         @OA\JsonContent(ref="#/components/schemas/ContraindicationsResult"),
     *     ),
     * )
     */
    public function doses(Request $request)
    {
        list($res, $data, $msg , $ex) =  ListsService::DosesList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Get(path="/lists/medications",
     *     tags={"Lists"},
     *     summary="medications List",
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

     *      @OA\Parameter(
     *         name="medication_name",
     *         in="query",
     *         description="search by medication name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="commercial_name",
     *         in="query",
     *         description="search by commercial name",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         in="query",
     *         description="id of category",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="shap_id",
     *         in="query",
     *         description="id of shap",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="contraindication_id",
     *         in="query",
     *         description="id of contraindication",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="company_id",
     *         in="query",
     *         description="id of company",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Success response",
     *         @OA\JsonContent(ref="#/components/schemas/MedicationResult"),
     *     ),
     * )
     */


    public function medications(Request $request)
    {



        list($res, $data, $msg , $ex) =  ListsService::MedicationsList($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }
}
