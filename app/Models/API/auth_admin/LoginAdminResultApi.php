<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\auth_admin;


use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginAdminResultApi
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="LoginAdminResultApi model",
 *     description="LoginAdminResultApi model",
 * )
 */
class LoginAdminResultApi extends Model
{

    protected $fillable = [
        'result' , 'isOk' , 'message',
    ];

    /**
     * @OA\Property(
     *     description="Result Model",
     *     title="result",
     * )
     *
     * @var LoginAdminResult
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

