<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CladdingApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CladdingApiModel model",
 *     description="CladdingApiModel model",
 * )
 */
class CladdingApiModel extends Model
{

    protected $fillable = [
        'id' , 'name', 'status'
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
     *     description="Name",
     *     title="name",
     * )
     *
     * @var string
     */
    public $name;

}

