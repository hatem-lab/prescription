<?php

/**
 * @license Apache 2.0
 */

namespace api\models\services;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class ServicesResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ServicesResult model",
 *     description="ServicesResult model",
 * )
 */
class ServicesResult extends Model
{
    /**
     * @OA\Property(
     *     description="ServiceApiModel Result Model",
     *     title="result",
     *     @OA\Items(ref="#/components/schemas/ServiceApiModel")
     * )
     *
     * @var array
     */
    public $result;

    /**
     * @OA\Property(
     *     description="Indicates if the response is ok or not",
     *     title="isOk",
     * )
     *
     * @var boolean
     */
    public $isOk;

    /**
     * @OA\Property(
     *     description="Api message",
     *     title="message",
     * )
     *
     * @var ApiMessage
     */
    public $message;

    /**
     * @OA\Property(
     *     description="pagesCount",
     *     title="pagesCount",
     * )
     *
     * @var integer
     */
    public $pagesCount;

}

