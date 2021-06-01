<?php

namespace common\enums;

class AddRemoveEnum extends PhpEnum {

    const add = 1;
    const remove = 2;

    public static function Labels() {
        return [
            self::add => \Yii::t('all', 'Add'),
            self::remove => \Yii::t('all', 'Remove'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::add => '<span class=" badge badge-sm" style="color: white; background-color: #003e68">'.\Yii::t('all','Add').'</span>',
            self::remove => '<span class=" badge badge-sm" style="color: white; background-color: #607d8b">'.\Yii::t('all','Remove').'</span>',
        ];
    }

}
