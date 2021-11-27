<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use api\models\auth\ProfileSummaryApiModel;
use App\Models\API\auth\ProfileResult;
use App\Models\API\lists\PreferenceApiModel;
use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class MedicationApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="MedicationApiModel model",
 *     description="MedicationApiModel model",
 * )
 */
class MedicationApiModel extends Model
{

    protected $fillable = [
        'id', 'medication_name' , 'medication_cost', 'commercial_name', 'category', 'shap','pages_count',
        'contraindication', 'caliber', 'company','dose'
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
     *     description="medication_name",
     *     title="medication_name",
     * )
     *
     * @var string
     */
    public $medication_name;

    /**
     * @OA\Property(
     *     description="commercial_name",
     *     title="commercial_name",
     * )
     *
     * @var string
     */
    public $commercial_name;
    /**
     * @OA\Property(
     *     description="Category",
     *     title="category",
     * )
     *
     * @var CategoryApiModel
     */
    public $category;

    /**
     * @OA\Property(
     *     description="shap",
     *     title="shap",
     * )
     *
     * @var ShapesApiModel
     */
    public $shap;

    /**
     * @OA\Property(
     *     description="contraindication",
     *     title="contraindication",
     * )
     *
     * @var ContraindicationsApiModel
     */
    public $contraindication;

    /**
     * @OA\Property(
     *     description="company",
     *     title="company",
     * )
     *
     * @var CompanyApiModel
     */
    public $company;

    /**
     * @OA\Property(
     *     description="company",
     *     title="company",
     * )
     *
     * @var DosesApiModel
     */
    public $dose;







}

