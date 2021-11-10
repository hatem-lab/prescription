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
protected $fillable=['id','city','region','password',
    'email','image','name','phone'];


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
     *     description="Last Name",
     *     title="last_name",
     * )
     *
     * @var string
     */
    public $name;

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
     *     description="email",
     *     title="email",
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     description="region",
     *     title="region",
     * )
     *
     * @var string
     */
    public $region;

    /**
     * @OA\Property(
     *     description="city",
     *     title="city",
     * )
     *
     * @var string
     */
    public $city;

    /**
     * @OA\Property(
     *     description="password",
     *     title="password",
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *     description="Image Url",
     *     title="image",
     * )
     *
     * @var string
     */
    public $image;













}

