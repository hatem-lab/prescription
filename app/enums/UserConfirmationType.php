<?php

namespace App\enums;

use App\enums\PhpEnum;

class UserConfirmationType extends PhpEnum {

    const account_confirm = 1;
    const forgot_password = 2;
    const forgot_password_email = 3;

    public static function Labels() {
        return [
            self::account_confirm => t('all', 'Account Confirm'),
            self::forgot_password => t('all', 'Forgot Password'),
            self::forgot_password_email => t('all', 'Forgot Password (sent by email)'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::account_confirm => '<span class=" badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Account Confirm').'</span>',
            self::forgot_password => '<span class="badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Forgot Password').'</span>',
            self::forgot_password_email => '<span class="badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Forgot Password (sent by email)').'</span>',
        ];
    }

}
