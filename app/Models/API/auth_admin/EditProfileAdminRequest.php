<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth_admin;


/**
 * Class EditProfileAdminRequest
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="EditProfileAdminRequest model",
 *     description="EditProfileAdminRequest model",
 * )
 */
class EditProfileAdminRequest
{
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
     *     description="password",
     *     title="password",
     * )
     *
     * @var string
     */
    public $password;

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
     *  description="User image",
     *  property="image",
     *  type="string",
     *  format="binary"
     * )
     *
     */

    public $image;


}
