<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class RegionApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RegionApiModel model",
 *     description="RegionApiModel model",
 * )
 */
class RegionApiModel extends Model
{

    protected $fillable = [
        'id' , 'name', 'city'
    ];

    /**
     * @OA\Property(
     *     description="City",
     *     title="city",
     * )
     *
     * @var CityApiModel
     */
    public $city;

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

