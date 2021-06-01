<?php

namespace common\enums;

class ProvidedEnum extends PhpEnum {

    const provided = 1;
    const not_provided = 0;

    public static function Labels() {
        return [
            self::provided => \Yii::t('all', 'Provided'),
            self::not_provided => \Yii::t('all', 'Not Provided'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::provided => '<span class=" badge badge-sm" style="color: white; background-color: #43b957">'.\Yii::t('all','Provided').'</span>',
            self::not_provided => '<span class=" badge badge-sm" style="color: white; background-color: #ff7600">'.\Yii::t('all','Not Provided').'</span>',
        ];
    }

}
