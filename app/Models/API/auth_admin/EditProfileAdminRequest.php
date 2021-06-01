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
     *  description="User image",
     *  property="image",
     *  type="string",
     *  format="binary"
     * )
     *
     */

    public $image;

    /**
     * @OA\Property(
     *     description="isOnline: 1 => Yes, 0 => No",
     *     enum={"0", "1"},
     *     title="isOnline",
     * )
     *
     * @var integer
     */
    public $isOnline;


    /**
     * @OA\Property(
     *     description="Region ID",
     *     title="region_id",
     * )
     *
     * @var integer
     */
    public $region_id;


    /**
     * @OA\Property(
     *     description="lat",
     *     title="lat",
     * )
     *
     * @var integer
     */
    public $lat;

    /**
     * @OA\Property(
     *     description="lng",
     *     title="lng",
     * )
     *
     * @var integer
     */
    public $lng;

}
