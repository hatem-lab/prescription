<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class SubCategoriesApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="SubCategoriesApiModel model",
 *     description="SubCategoriesApiModel model",
 * )
 */
class SubCategoriesApiModel extends Model
{

    protected $fillable = [
        'id' , 'name','sub_categories'
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
     *     description="Name",
     *     title="name",
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     description="Property Details",
     *     title="property_details",
     * )
     *
     * @var SubCategoriesApiModel
     */
    public $sub_categories;



}

