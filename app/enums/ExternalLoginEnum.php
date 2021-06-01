<?php

namespace common\enums;

class ExternalLoginEnum extends PhpEnum {

    const facebook = 1;
    const google = 2;

    public static function Labels() {
        return [
            self::facebook => \Yii::t('all', 'Facebook'),
            self::google => \Yii::t('all', 'Google'),
        ];
    }


}
