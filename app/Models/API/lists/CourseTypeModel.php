<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use App\Models\API\services\CourseApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class PreferenceApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="PreferenceApiModel model",
 *     description="PreferenceApiModel model",
 * )
 */
class CourseTypeModel extends Model
{

    protected $fillable = [
        'id' , 'type','status','courses'
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
     *     description="type",
     *     title="type",
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *     description="status",
     *     title="status",
     * )
     *
     * @var integer
     */
    public $status;

    /**
     * @OA\Property(
     *     description="courses",
     *     title="courses",
     * )
     *
     * @var CourseApiModel

     */
    public $courses;

}

