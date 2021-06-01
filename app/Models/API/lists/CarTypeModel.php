<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;


use Illuminate\Database\Eloquent\Model;

/**
 * Class CarTypeModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="CarTypeModel model",
 *     description="CarTypeModel model",
 * )
 */

class CarTypeModel extends Model
{
    protected $fillable = [
        'id' , 'car_type' , 'icon'
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
     *     description="Car Type",
     *     title="car_type",
     * )
     *
     * @var string
     */
    public $car_type;

    /**
     * @OA\Property(
     *     description="Icon",
     *     title="icon",
     * )
     *
     * @var string
     */
    public $icon;


}

