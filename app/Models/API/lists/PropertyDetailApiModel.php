<?php

/**
 * @license Apache 2.0
 */

namespace App\Models\API\lists;

use api\models\auth\ProfileSummaryApiModel;
use App\Models\API\auth\ProfileResult;
use App\Models\API\other\IdValueApiModel;
use Illuminate\Database\Eloquent\Model;


/**
 * Class PropertyDetailApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="PropertyDetailApiModel model",
 *     description="PropertyDetailApiModel model",
 * )
 */
class PropertyDetailApiModel extends Model
{

    protected $fillable = [
        'id', 'name', 'min_price', 'max_price', 'min_area_size', 'max_area_size',
        'bathroom_count', 'bedroom_count', 'floor_number',
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
     *     description="Min Price",
     *     title="min_price",
     * )
     *
     * @var integer
     */
    public $min_price;

    /**
     * @OA\Property(
     *     description="Max Price",
     *     title="max_price",
     * )
     *
     * @var integer
     */
    public $max_price;


    /**
     * @OA\Property(
     *     description="Bedroom Count",
     *     title="bedroom_count",
     * )
     *
     * @var integer
     */
    public $bedroom_count;

    /**
     * @OA\Property(
     *     description="Pathroom Count",
     *     title="pathroom_count",
     * )
     *
     * @var integer
     */
    public $bathroom_count;

    /**
     * @OA\Property(
     *     description="Min Area Size",
     *     title="min_area_size",
     * )
     *
     * @var integer
     */
    public $min_area_size;

    /**
     * @OA\Property(
     *     description="Max Area Size",
     *     title="max_area_size",
     * )
     *
     * @var integer
     */
    public $max_area_size;

    /**
     * @OA\Property(
     *     description="Floor Number",
     *     title="floor_number",
     * )
     *
     * @var integer
     */
    public $floor_number;

}

