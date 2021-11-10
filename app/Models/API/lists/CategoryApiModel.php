<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class CategoryApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CategoryApiModel model",
 *     description="CategoryApiModel model",
 * )
 */
class CategoryApiModel extends Model
{

    protected $fillable = [
        'id' , 'name', 'icon', 'property_details', 'preferences','range_prices'
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

    /**
     * @OA\Property(
     *     description="Icon",
     *     title="icon",
     * )
     *
     * @var string
     */
    public $icon;


    /**
     * @OA\Property(
     *     description="Property Details",
     *     title="property_details",
     * )
     *
     * @var PropertyDetailApiModel
     */
    public $property_details;


    /**
     * @OA\Property(
     *     description="Preferences",
     *     title="preferences",
     * )
     *
     * @var PreferenceApiModel
     */
    public $preferences;
    
    /**
     * @OA\Property(
     *     description="ranges_prices",
     *     title="ranges_prices",
     * )
     *
     * @var CategoryApiModel
     */
    public $range_prices;

}

