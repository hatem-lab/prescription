<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth_admin;

use App\Models\API\location\CityDetailsApiModel;
use App\Models\API\location\CountryDetailsApiModel;
use App\Models\API\location\Location;
use App\Models\API\location\LocationAdmin;
use App\Models\API\location\LocationApiModel;
use App\Models\API\location\RegionApiModel;
use App\Models\API\other\CarImage;
use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProfileResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ProfileResult model",
 *     description="ProfileResult model",
 * )
 */
class ProfileAdminResult extends Model
{

    protected $fillable = [
        'id' , 'first_name' , 'last_name' ,
        'phone' , 'image' , 'NumberOfDeliveryOperation',
        'location' , 'isOnline', 'car_details',
        'rate' , 'rate_count'
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
     *     description="First Name",
     *     title="first_name",
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *     description="Last Name",
     *     title="last_name",
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *     description="Phone",
     *     title="phone",
     * )
     *
     * @var string
     */
    public $phone;


    /**
     * @OA\Property(
     *     description="Image Url",
     *     title="image",
     * )
     *
     * @var string
     */
    public $image;

    /**
     * @OA\Property(
     *     description="Number of delivery oberation",
     *     title="number_of_delivery_oberation",
     * )
     *
     * @var integer
     */
    public $NumberOfDeliveryOperation;


    /**
     * @OA\Property(
     *     description="Car Details",
     *     title="car_details",
     *     @OA\Items(ref="#/components/schemas/CarDetails")
     * )
     *
     * @var array
     */

    public $car_details;

    /**
     * @OA\Property(
     *     description="Country",
     *     title="country",
     * )
     *
     * @var LocationAdmin
     */
    public $location;


    /**
     * @OA\Property(
     *     description="Is Online",
     *     title="is_online",
     * )
     *
     * @var IdValueApiModel
     */

    public $isOnline;

    /**
     * @OA\Property(
     *     description="Rate Count",
     *     title="rate_count",
     * )
     *
     * @var integer
     */

    public $rate_count;

    /**
     * @OA\Property(
     *     description="Rate",
     *     title="rate",
     * )
     *
     * @var double
     */

    public $rate;


}

