<?php

/**
 * @license Apache 2.0
 */

namespace api\models\auth_admin;


/**
 * Class RegisterAdminModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RegisterAdminModel model",
 *     description="RegisterAdminModel model",
 * )
 */
class RegisterAdminModel
{
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
     *     description="Account Password",
     *     title="password",
     * )
     *
     * @var string
     */
    public $password;

}

