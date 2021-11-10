<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;
use Illuminate\Database\Eloquent\Model;


/**
 * Class RegisterModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RegisterModel model",
 *     description="RegisterModel model",
 * )
 */
class RegisterModel extends Model
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
     *     description="name",
     *     title="name",
     * )
     *
     * @var string
     */
    public $name;

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

