<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CityApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CityApiModel model",
 *     description="CityApiModel model",
 * )
 */
class CityRegionApiModel extends Model
{

    protected $fillable = [
        'region', 'id' , 'name'
    ];

    /**
     * @OA\Property(
     *     description="Region",
     *     title="region",
     * )
     *
     * @var string
     */
    public $region;

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

