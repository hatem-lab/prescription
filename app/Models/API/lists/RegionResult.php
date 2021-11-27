<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;



use App\Models\API\other\ApiMessage;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RegionResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RegionResult model",
 *     description="RegionResult model",
 * )
 */
class RegionResult extends Model
{
    protected $fillable = [
        'items_count','result' , 'isOk' , 'message'
    ];
/**
     * @OA\Property(
     *     description="items_count",
     *     title="items_count",
     * )
     *
     * @var integer
     */
    public $items_count;
    
    /**
     * @OA\Property(
     *     description="RegionApiModel Result Model",
     *     title="result",
     *     @OA\Items(ref="#/components/schemas/RegionApiModel")
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
