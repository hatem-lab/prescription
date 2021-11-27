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
class RangesPriceModel extends Model
{

    protected $fillable = [
        'id' , 'cash_category', 'category', 'max_price', 'min_price','rent_status'
    ];

    /**
     * @OA\Property(
     *     description="ID",
     *     title="id",
     * )
     *
     * @var integer
     */
    public $id;

   

    /**
     * @OA\Property(
     *     description="cash_category",
     *     title="cash_category",
     * )
     *
     * @var string
     */
    public $cash_category;


    /**
     * @OA\Property(
     *     description="Property Request Preferences",
     *     title="preferences",
     * )
     *
     * @var CategoryModel
     */
    public $category;

 /**
     * @OA\Property(
     *     description="max_price",
     *     title="max_price",
     * )
     *
     * @var integer
     */
    public $max_price;
    
     /**
     * @OA\Property(
     *     description="min_price",
     *     title="min_price",
     * )
     *
     * @var integer
     */
    public $min_price;
    
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

