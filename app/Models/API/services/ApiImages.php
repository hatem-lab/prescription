<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


/**
 * Class RequestResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ApiImages model",
 *     description="ApiImages model",
 * )
 */
class ApiImages extends Model
{
    protected $fillable = [
        'id','file'
    ];


    /**
     * @OA\Property(
     *     description="id of image",
     *     title="id",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *     description="file",
     *     title="file",
     * )
     *
     * @var string
     */
    public $file;

}
