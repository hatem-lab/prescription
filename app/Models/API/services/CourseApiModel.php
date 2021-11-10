<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use App\Models\API\auth\ProfileResult;
use App\Models\API\lists\MedicationModel;
use App\Models\API\lists\PreferenceApiModel;
use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\API\lists\CategoryModel;
use App\Models\API\lists\RegionApiModel;
/**
 * Class CourseApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CourseApiModel model",
 *     description="CourseApiModel model",
 * )
 */

class CourseApiModel extends Model
{
    protected $fillable = [
        'id' , 'title', 'content','coures_type','user','pages_count','media','view_count'
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
     *     description="title",
     *     title="title",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     description="content",
     *     title="content",
     * )
     *
     * @var string
     */
    public $content;

    /**
     * @OA\Property(
     *     description="coures_type",
     *     title="coures_type",
     * )
     *
     * @var CourseTypeModel
     */
    public $coures_type;


    /**
     * @OA\Property(
     *     description="user",
     *     title="user",
     * )
     *
     * @var ProfileResult
     */
    public $user;

    /**
     * @OA\Property(
     *     description="media",
     *     title="media",
     * )
     *
     * @var ApiImages
     */
    public $media;
/**
     * @OA\Property(
     *     description="view_count",
     *     title="view_count",
     * )
     *
     * @var integer
     */
    public $view_count;

}


