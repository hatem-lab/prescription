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
 * Class ChangePasswordPayload
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ChangePasswordPayload model",
 *     description="ChangePasswordPayload model",
 * )
 */
class ChangePasswordPayload extends Model
{
    /**
     * @OA\Property(
     *     description="User old password",
     *     title="oldPassword",
     * )
     *
     * @var string
     */
    public $oldPassword;

    /**
     * @OA\Property(
     *     description="User new password",
     *     title="newPassword",
     * )
     *
     * @var string
     */
    public $newPassword;

}

