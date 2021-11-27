<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\API\lists\CategoryModel;

/**
 * Class RangesPriceModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RangesPriceModel model",
 *     description="RangesPriceModel model",
 * )
 */
class RangesPricePayload extends Model
{

    protected $fillable = [
         'category_id','rent_status'
    ];

  

   

    /**
     * @OA\Property(
     *     description="category_id",
     *     title="category_id",
     * )
     *
     * @var integer
     */
    public $category_id;


    

    
    /**
     * @OA\Property(
     *     description="Type of rent_status, 1 => Sell, 2 => Rent",
     *     enum={"1", "2"},
     *     title="rent_status",
     * )
     *
     * @var string
     */
    public $rent_status;
    

}

