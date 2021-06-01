<?php

namespace App\enums;


class AdminType extends PhpEnum {

    const delivery_guy = 1;
    const system_admin = 2;

    public static function Labels() {
        return [
            self::delivery_guy => trans( 'Delivery Guy'),
            self::system_admin => trans( 'System Admin'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::delivery_guy => '<span class=" badge badge-sm" style="color: white; background-color: #607d8b">'
                .trans('Delivery Guy').'</span>',

            self::system_admin => '<span class="badge badge-sm" style="color: white; background-color: #607d8b">'
                .trans('System Admin').'</span>',
        ];
    }

}
