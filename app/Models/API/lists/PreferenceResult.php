<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;



use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PreferenceResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="PreferenceResult model",
 *     description="PreferenceResult model",
 * )
 */
class PreferenceResult extends Model
{
    protected $fillable = [
        'result' , 'isOk' , 'message'
    ];

    /**
     * @OA\Property(
     *     description="PreferenceApiModel Result Model",
     *     title="result",
     *     @OA\Items(ref="#/components/schemas/PreferenceApiModel")
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

    /**
     * @OA\Property(
     *     description="Pages count of list (by page size)",
     *     title="pagesCount",
     * )
     *
     * @var integer
     */
    public $pagesCount;


}
