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
 *     title="OfferModel model",
 *     description="OfferModel model",
 * )
 */
class View_Offer extends Model
{
    protected $table="view_properties";
    protected  $fillable=['user_id','property_id','views_count'];


    /**
     * @OA\Property(
     *     description="property_id",
     *     title="property_id",
     * )
     *
     * @var integer
     */
    public $property_id;
    /**
     * @OA\Property(
     *     description="user_id",
     *     title="user_id",
     * )
     *
     * @var integer
     */
    public $user_id;

/**
     * @OA\Property(
     *     description="views_count",
     *     title="views_count",
     * )
     *
     * @var integer
     */
    public $views_count;


    

    
    
}

