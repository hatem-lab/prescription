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
     *     description="Phone",
     *     title="phone",
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *     description="firstname",
     *     title="firstname",
     * )
     *
     * @var string
     */
    public $firstname;
    /**
     * @OA\Property(
     *     description="lastname",
     *     title="lastname",
     * )
     *
     * @var string
     */
    public $lastname;
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

