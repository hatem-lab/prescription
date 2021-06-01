<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth_admin;


use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ApiResultProfileAdminResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ApiResultProfileAdminResult model",
 *     description="ApiResultProfileAdminResult model",
 * )
 */
class ApiResultProfileAdminResult extends Model
{

    protected $fillable = [
        'result' , 'isOk' , 'message'
    ];

    /**
     * @OA\Property(
     *     description="Result Model",
     *     title="result",
     * )
     *
     * @var ProfileAdminResult
     */
    public $result;

    /**
     * @OA\Property(
     *     description="Indicates if the response is ok or not",
     *     title="isOk",
     * )
     *
     * @var boolean
     */
    public $isOk;

    /**
     * @OA\Property(
     *     description="Api message",
     *     title="message",
     * )
     *
     * @var ApiMessage
     */
    public $message;
}

