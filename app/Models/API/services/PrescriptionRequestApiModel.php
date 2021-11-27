<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use App\Models\API\auth\ProfileResult;
use App\Models\API\lists\CladdingApiModel;
use App\Models\API\lists\PreferenceApiModel;
use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\API\lists\CategoryModel;
use App\Models\API\lists\RegionApiModel;
/**
 * Class PropertyRequestApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="PropertyRequestApiModel model",
 *     description="PropertyRequestApiModel model",
 * )
 */

class PrescriptionRequestApiModel extends Model
{
    protected $fillable = [
        'id' , 'costomer', 'doctor', 'date_prescription','pages_count','date_prescription_renewal','date_prescription_send_to_doctor',
        'date_prescription_processed', 'date_prescription_from_doctor','date_prescription_recived_from_doctor','date_prescription_sent_to_comany','date_prescription_filled','medications',
        'precription_quantity','instruction_to_customer'
    ];

    /**
     * @OA\Property(
     *     description="ID",
     *     title="id",
     * )
     *
     * @var integer
     */
    public $id;

/**
     * @OA\Property(
     *     description="pages_count",
     *     title="pages_count",
     * )
     *
     * @var integer
     */
    public $pages_count;

    /**
     * @OA\Property(
     *     description="costomer_id",
     *     title="costomer_id",
     * )
     *
     * @var integer
     */
    public $costomer;

    /**
     * @OA\Property(
     *     description="doctor_id",
     *     title="doctor_id",
     * )
     *
     * @var integer
     */
    public $doctor;

    /**
     * @OA\Property(
     *     description="medications_ids",
     *     title="medications_ids",
     * @OA\Items(type="integer")
     * )
     *
     * @var array
     */
    public $medications_ids;

    /**
     * @OA\Property(
     *     description="precription_quantity",
     *     title="precription_quantity",
     * )
     *
     * @var integer
     */
    public $precription_quantity;

    /**
     * @OA\Property(
     *     description="instruction_to_customer",
     *     title="instruction_to_customer",
     * )
     *
     * @var string
     */
    public $instruction_to_customer;

    /**
     * @OA\Property(
     *     description="date_prescription",
     *    format="datetime",
     *     title="date_prescription",
     *    type="string"
     * )
     *
     * @var \DateTime
     */

    public $date_prescription;
    /**
     * @OA\Property(
     *     description="date_prescription_renewal",
     *    format="datetime",
     *     title="date_prescription_renewal",
     *    type="string"
     * )
     *
     * @var \DateTime
     */

    public $date_prescription_renewal;

    /**
     * @OA\Property(
     *     description="date_prescription_send_to_doctor",
     *    format="datetime",
     *     title="date_prescription_send_to_doctor",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_send_to_doctor;

    /**
     * @OA\Property(
     *     description="date_prescription_processed",
     *    format="datetime",
     *     title="date_prescription_processed",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_processed;

    /**
     * @OA\Property(
     *     description="date_prescription_processed",
     *    format="datetime",
     *     title="date_prescription_processed",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_from_doctor;

    /**
     * @OA\Property(
     *     description="date_prescription_recived_from_doctor",
     *    format="datetime",
     *     title="date_prescription_recived_from_doctor",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_recived_from_doctor;

    /**
     * @OA\Property(
     *     description="date_prescription_sent_to_comany",
     *    format="datetime",
     *     title="date_prescription_sent_to_comany",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_sent_to_comany;


    /**
     * @OA\Property(
     *     description="date_prescription_filled",
     *    format="datetime",
     *     title="date_prescription_filled",
     *    type="string"
     * )
     *
     * @var string
     */

    public $date_prescription_filled;

}


