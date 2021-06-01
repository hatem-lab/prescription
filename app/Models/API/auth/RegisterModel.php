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
}

