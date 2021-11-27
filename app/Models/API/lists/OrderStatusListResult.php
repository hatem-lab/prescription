<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStatusListResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="OrderStatusListResult model",
 *     description="OrderStatusListResult model",
 * )
 */
class OrderStatusListResult extends Model
{
    protected $fillable = [
        'result' , 'isOk' , 'message'
    ];

    /**
     * @OA\Property(
     *     description="OrderStatusListModel Result Model",
     *     title="result",
     *     @OA\Items(ref="#/components/schemas/OrderStatusListModel")
     * )
     *
     * @var array
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

