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

    /**
     * @OA\Get(path="/services/all-prescriptions",
     *     tags={"Prescriptions"},
     *     summary="all prescriptions",
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
     *         @OA\JsonContent(ref="#/components/schemas/PrescriptionResult"),
     *     ),
     * )
     */

    public function all_prescriptions(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::AllPrescription($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Get(path="/services/prescriptions-details",
     *     tags={"Prescriptions"},
     *     summary="prescription details",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of prescription",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "MedicationResult response",
     *         @OA\JsonContent(ref="#/components/schemas/PrescriptionResult"),
     *     ),
     * )
     */

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
     * @OA\Get(path="/services/medication-details",
     *     tags={"Medications"},
     *     summary="medication details",
     *     @OA\Parameter(
     *         name="id",
     *         description="ID of Medication",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "MedicationResult response",
     *         @OA\JsonContent(ref="#/components/schemas/MedicationResult"),
     *     ),
     * )
     */

    public function medication_details(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::MedicationDetails($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }



    /**
     * @OA\Get(path="/services/all-medications",
     *     tags={"Medications"},
     *     summary="Get All Medications",
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
     *         description = "MedicationResult response",
     *         @OA\JsonContent(ref="#/components/schemas/MedicationResult"),
     *     ),
     * )
     */

    public function all_medications(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::AllMedicatios($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }


    /**
     * @OA\Post(path="/services/create-prescription",
     *     tags={"Prescriptions"},
     *     summary="Create New Prescription",
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
     *              @OA\Schema(ref="#components/schemas/CreatePrescriptionPayLoad"),
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/PrescriptionResult"),
     *     ),
     * )
     */

    public function create_prescription(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::CreatePrescription($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }




    /**
     * @OA\Post(path="/services/update-prescription",
     *     tags={"Prescriptions"},
     *     summary="Update Prescription",
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
     *              @OA\Schema(ref="#components/schemas/UpdatePrescriptionPayLoad"),
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "RequestResult response",
     *         @OA\JsonContent(ref="#/components/schemas/PrescriptionResult"),
     *     ),
     * )
     */

    public function update_prescription(Request $request)
    {
        list($res, $data, $msg , $ex) =  RequestsService::UpdatePrescription($request);
        if($res){
            return response()->json($data);
        } else {
            return returnError($msg , $ex);
        }
    }

    /**
     * @OA\Post(path="/services/delete-prescription",
     *     tags={"Prescriptions"},
     *     summary="delete Prescription",
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
     *         @OA\JsonContent(ref="#/components/schemas/DeletePrescriptionPayload")
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

    public function delete_prescription(Request $request)
    {
        return RequestsService::deletePrescription($request);
    }


}
