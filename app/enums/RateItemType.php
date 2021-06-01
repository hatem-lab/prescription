<?php

namespace common\enums;

class RateItemType extends PhpEnum {

    const product = 1;

    public static function Labels() {
        return [
            self::product => t('Product'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::product => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Product').'</span>',
        ];
    }

}
