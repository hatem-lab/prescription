<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\offers;
use Facade\FlareClient\Time\Time;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;


/**
 * Class OfferViewPayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="OfferViewPayload model",
 *     description="OfferViewPayload model",
 * )
 */
class OfferViewPayload extends Model
{
   

    


    /**
     * @OA\Property(
     *     description="property_id",
     *     title="property_id",
     * )
     *
     * @var integer
     */
    public $property_id;

  
    
}

