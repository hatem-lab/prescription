<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\offers;
use Facade\FlareClient\Time\Time;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;


/**
 * Class OrderModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="OfferCreateModelApi model",
 *     description="OfferCreateModelApi model",
 * )
 */
class OfferCreateModelApi extends Model
{
    protected $table="offers";
    protected  $fillable=['description','whatsapp','phone'];


    

    /**
     * @OA\Property(
     *     description="Description",
     *     title="description",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     description="Whatsapp",
     *     title="whatsapp",
     * )
     *
     * @var string
     */
    public $whatsapp;

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
     *  @OA\Property(
     * description="Item image",
     *  property="image[]",
     * type="array",
     *   @OA\Items(type="string", format="binary")
     *  )
     *
     */

    public $image;
    
    /**
     *  @OA\Property(
     * description="Item video",
     *  property="video[]",
     * type="array",
     *   @OA\Items(type="string", format="binary")
     *  )
     *
     */

    public $video;
    
}

