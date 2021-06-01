<?php

namespace App\enums;

class UserStatus extends PhpEnum {

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_BANNED = -1;

    public static function Labels() {
        return [
            self::STATUS_ACTIVE => trans( 'Active'),
            self::STATUS_INACTIVE => trans( 'Not Active'),
            self::STATUS_BANNED => trans( 'Banned'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::STATUS_ACTIVE => '<span>'.trans('Active').'</span>',
            self::STATUS_INACTIVE => '<span>'.trans('Not Active').'</span>',
            self::STATUS_BANNED => '<span>' .trans('Banned').'</span>',
        ];
    }

    public static function Styles() {
        return [
            self::STATUS_ACTIVE => 'background-color: #607d8b !important',
            self::STATUS_INACTIVE => 'background-color: #003e68 !important',
            self::STATUS_BANNED => 'background-color: #607d8b !important',
        ];
    }


}
