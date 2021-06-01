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
 * Class RequestFileApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RequestFileApiModel model",
 *     description="RequestFileApiModel model",
 * )
 */
class RequestFileApiModel extends Model
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
     *     description="file",
     *     title="file",
     * )
     *
     * @var string
     */
    public $file;




}

