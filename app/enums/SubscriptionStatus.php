<?php

namespace common\enums;

class SubscriptionStatus extends PhpEnum {

    const active = 1;
    const ended = 2;

    public static function Labels() {
        return [
            self::active => t('Active'),
            self::ended => t('Ended'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::active => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Active').'</span>',
            self::ended => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ff2000">' .t('Ended').'</span>',
        ];
    }

}
