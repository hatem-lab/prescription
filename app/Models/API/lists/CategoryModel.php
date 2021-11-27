<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
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
class CategoryModel extends Model
{

    protected $fillable = [
        'id' , 'name'
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

