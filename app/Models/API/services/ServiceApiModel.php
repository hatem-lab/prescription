<?php

/**
 * @license Apache 2.0
 */

namespace api\models\services;

use api\models\business\BusinessApiModel;
use api\models\location\City;
use api\models\location\CityApiModel;
use api\models\other\IdValueApiModel;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class ServiceApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ServiceApiModel model",
 *     description="ServiceApiModel model",
 * )
 */
class ServiceApiModel extends Model
{
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
     *     description="type",
     *     title="type",
     * )
     *
     * @var IdValueApiModel
     */
    public $type;

    /**
     * @OA\Property(
     *     description="title",
     *     title="title",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     description="sub_title",
     *     title="sub_title",
     * )
     *
     * @var string
     */
    public $sub_title;

    /**
     * @OA\Property(
     *     description="description",
     *     title="description",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     description="price",
     *     title="price",
     * )
     *
     * @var float
     */
    public $price;



}

