<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use Illuminate\Database\Eloquent\Model;

/**
 * Class DeleteCoursePayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="DeleteCoursePayload model",
 *     description="DeleteCoursePayload model",
 * )
 */
class DeleteCoursePayload extends Model
{

    protected $fillable = [
        'course_id'

    ];

    /**
     * @OA\Property(
     *     description="Id of course",
     *     title="course_id",
     * )
     *
     * @var integer
     */
    public $course_id;




}

