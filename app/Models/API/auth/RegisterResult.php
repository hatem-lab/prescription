<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegisterResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RegisterResult model",
 *     description="RegisterResult model",
 * )
 */
class RegisterResult extends Model
{

    protected $fillable = ['phone','firstname','lastname', 'message'];

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
     *
     * @OA\Property(
     *     description="Message",
     *     title="message",
     * )
     *
     * @var string
     */
    public $message;
}

