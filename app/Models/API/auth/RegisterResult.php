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

    protected $fillable = ['email','name', 'message'];

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

