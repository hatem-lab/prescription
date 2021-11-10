<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use Illuminate\Database\Eloquent\Model;

/**
 * Class CreatePrescriptionPayLoad
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CreatePrescriptionPayLoad model",
 *     description="CreatePrescriptionPayLoad model",
 * )
 */
class UpdateCoursePayLoad extends Model
{

    protected $fillable = [
        'course_id','title', 'content','type_id','user_id','media'
    ];


    /**
     * @OA\Property(
     *     description="course_id",
     *     title="course_id",
     * )
     *
     * @var integer
     */
    public $course_id;

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
     *     description="type_id",
     *     title="type_id",
     * )
     *
     * @var integer
     */
    public $type_id;

    /**
     * @OA\Property(
     *     description="user_id",
     *     title="user_id",
     * )
     *
     * @var integer
     */
    public $user_id;

    /**
     *  @OA\Property(
     * description="Item media",
     *  property="media[]",
     * type="array",
     *   @OA\Items(type="string", format="binary")
     *  )
     *
     */

    public $media;

}

