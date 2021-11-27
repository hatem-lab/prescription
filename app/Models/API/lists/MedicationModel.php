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
 * Class MedicationModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="MedicationModel model",
 *     description="MedicationModel model",
 * )
 */
class MedicationModel extends Model
{

    protected $fillable = [
        'id', 'medication_name' , 'medication_cost', 'commercial_name', 'category', 'shap',
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

