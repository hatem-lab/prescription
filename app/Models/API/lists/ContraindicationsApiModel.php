<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class ContraindicationsApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ContraindicationsApiModel model",
 *     description="ContraindicationsApiModel model",
 * )
 */
class ContraindicationsApiModel extends Model
{

    protected $fillable = [
        'id' ,'content','title'
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
     *     description="content",
     *     title="content",
     * )
     *
     * @var string
     */
    public $content;


    /**
     * @OA\Property(
     *     description="title",
     *     title="title",
     * )
     *
     * @var string
     */
    public $title;



}

