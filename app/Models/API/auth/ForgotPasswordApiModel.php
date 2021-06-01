<?php

/**
 * @license Apache 2.0
 */

namespace api\models\auth;

use api\models\other\Category;
use api\models\other\Region;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class ForgotPasswordApiModel
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ForgotPasswordApiModel model",
 *     description="ForgotPasswordApiModel model",
 * )
 */
class ForgotPasswordApiModel extends Model
{
    /**
     * @OA\Property(
     *     description="Account phone (will send code to if phone is not empty)",
     *     title="phone",
     * )
     *
     * @var string
     */
    public $phone;


}

