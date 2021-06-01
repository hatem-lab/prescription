<?php

namespace common\enums;

class UserTypeEnum extends PhpEnum {

    const student = 1;
    const teacher = 2;
    const university = 3;
    const admin = 4;

    public static function Labels() {
        return [
            self::student => \Yii::t('all', 'Student'),
            self::teacher => \Yii::t('all', 'Teacher'),
            self::university => \Yii::t('all', 'University'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::student => '<span class=" badge badge-sm" style="color: white; background-color: #607d8b">' .\Yii::t('all','Student').'</span>',
            self::teacher => '<span class="badge badge-sm" style="color: white; background-color: #607d8b">' .\Yii::t('all','Teacher').'</span>',
            self::university => '<span class="badge badge-sm" style="color: white; background-color: #003e68">' .\Yii::t('all','University').'</span>',
        ];
    }

}
