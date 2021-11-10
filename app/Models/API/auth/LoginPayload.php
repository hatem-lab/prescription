<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;


use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginPayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="LoginPayload model",
 *     description="LoginPayload model",
 * )
 */
class LoginPayload extends Model
{
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

}

