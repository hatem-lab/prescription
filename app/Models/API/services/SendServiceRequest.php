<?php

/**
 * @license Apache 2.0
 */

namespace api\models\services;

use api\models\other\Category;
use api\models\other\Region;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class SendServiceRequest
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="SendServiceRequest model",
 *     description="SendServiceRequest model",
 * )
 */
class SendServiceRequest extends Model
{
    /**
     * @OA\Property(
     *     description="service_type {2 => commercial_register, 3 => certification_service}",
     *     enum={2, 3},
     *     title="service_type",
     * )
     *
     * @var integer
     */
    public $service_type;

    /**
     * @OA\Property(
     *     description="type_id",
     *     title="type_id",
     * )
     *
     * @var integer
     */
    public $type_id;

    /**
     * @OA\Property(
     *     description="IDs of uploaded files",
     *     title="file_id",
     *     @OA\Items(type="integer")
     * )
     *
     * @var array
     */
    public $file_id;






}

