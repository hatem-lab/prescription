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

