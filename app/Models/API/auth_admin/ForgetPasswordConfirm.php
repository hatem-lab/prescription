<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ConfirmAccountModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ConfirmAccountModel model",
 *     description="ConfirmAccountModel model",
 * )
 */
class ForgetPasswordConfirm
{
    /**
     * @OA\Property(
     *     description="The phone of user to verify",
     *     title="phone",
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *     description="Verification Code",
     *     title="code",
     * )
     *
     * @var string
     */
    public $code;

    /**
     * @OA\Property(
     *     description="Verification Code",
     *     title="code",
     * )
     *
     * @var string
     */
    public $newPassword;

}

