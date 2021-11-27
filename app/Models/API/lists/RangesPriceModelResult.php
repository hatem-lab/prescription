<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\services;

use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


/**
 * Class RequestResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="OfferResult model",
 *     description="OfferResult model",
 * )
 */
class RangesPriceModelResult extends Model
{
    protected $fillable = [
        'result', 'isOk' , 'message'
    ];
     /**
     * @OA\Property(
     *     description="RangesPriceModel Result Model",
     *     title="result",
     *     @OA\Items(ref="#/components/schemas/RangesPriceModel")
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
