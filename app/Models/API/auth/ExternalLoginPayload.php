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
 * Class ExternalLoginPayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ExternalLoginPayload model",
 *     description="ExternalLoginPayload model",
 * )
 */
class ExternalLoginPayload extends Model
{
    /**
     * @OA\Property(
     *     description="The login provider used to login Please send 1 For facebook and 2 for Google",
     *     title="provider",
     * )
     *
     * @var integer
     */
    public $provider;

    /**
     * @OA\Property(
     *     description="the access token sent from login provider",
     *     title="token",
     * )
     *
     * @var string
     */
    public $token;


}

