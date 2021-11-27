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
 *     title="CategoryModel model",
 *     description="CategoryModel model",
 * )
 */

class CarTypeModel extends Model
{
    protected $fillable = [
        'category_icon' , 'category_name'
    ];

    /**
     * @OA\Property(
     *     description="category_icon",
     *     title="category_icon",
     * )
     *
     * @var string
     */
    public $category_icon;


    /**
     * @OA\Property(
     *     description="category_name",
     *     title="category_name",
     * )
     *
     * @var string
     */
    public $category_name;




}

