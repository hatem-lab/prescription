<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;


use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="LoginResult model",
 *     description="LoginResult model",
 * )
 */
class LoginResult
{

    /**
     * @OA\Property(
     *     description=">-
    Code of resonse (response type)
        1 => Login Accepted
        2 => Invalid Password
        3 => Account not Confirmed
        4 => User is BANNED
        5 => Account not Active
        6 => User not found",
     *     title="resultCode",
     * )
     *
     * @var integer
     */
    public $resultCode;

    /**
     * @OA\Property(
     *     description="Result text to show for user",
     *     title="resultText",
     * )
     *
     * @var string
     */
    public $resultText;

    /**
     * @OA\Property(
     *     description="Access token",
     *     title="token",
     * )
     *
     * @var string
     */
    public $token;

    /**
     * @OA\Property(
     *     description="Profile data",
     *     title="profile",
     * )
     *
     * @var ProfileResult
     */
    public $profile;

}

