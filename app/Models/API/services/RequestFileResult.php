<?php

/**
 * @license Apache 2.0
 */

namespace api\models\services;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class RequestFileResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="RequestFileResult model",
 *     description="RequestFileResult model",
 * )
 */
class RequestFileResult extends Model
{
    /**
     * @OA\Property(
     *     description="result",
     *     title="result",
     * )
     *
     * @var RequestFileApiModel
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


}

