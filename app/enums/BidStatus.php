<?php

namespace common\enums;

class BidStatus extends PhpEnum {

    const available = 1;
    const closed = 2;

    public static function Labels() {
        return [
            self::available => t('Available'),
            self::closed => t('Closed'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::available => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #34ff2c">' .t('Available').'</span>',
            self::closed => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #ff0000">' .t('Closed').'</span>',
        ];
    }

}
