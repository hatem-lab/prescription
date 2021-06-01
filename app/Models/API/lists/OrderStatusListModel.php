<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;


use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderStatusListModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="OrderStatusListModel model",
 *     description="OrderStatusListModel model",
 * )
 */

class OrderStatusListModel extends Model
{
    protected $fillable = [
        'id' , 'status'
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
     *     description="Order Status",
     *     title="status",
     * )
     *
     * @var string
     */
    public $status;


}

