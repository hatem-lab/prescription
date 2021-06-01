<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;



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
class ProfileResult extends Model
{
    protected $fillable = [
        'id' , 'first_name' , 'last_name' ,
        'phone' , 'image'
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
     *     description="Locations",
     *     title="locations",
     *     @OA\Items(ref="#/components/schemas/Location")
     * )
     *
     * @var array
     */
    public $locations;

}

