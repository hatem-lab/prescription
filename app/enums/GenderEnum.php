<?php

namespace common\enums;

class GenderEnum extends PhpEnum {

    const male = 1;
    const female = 2;

    public static function Labels() {
        return [
            self::male => \Yii::t('all', 'Male'),
            self::female => \Yii::t('all', 'Female'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::male => '<span class=" badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','Male').'</span>',
            self::female => '<span class=" badge badge-sm" style="color: white; background-color: #607d8b">'.\Yii::t('all','Female').'</span>',
        ];
    }

}
