<?php

namespace App\enums;

class RequestStatus extends PhpEnum {

    const new_request = 1;
    const reserved = 2;
    const on_way = 3;
    const delivered = 4;

    public static function Labels() {
        return [
            self::new_request => trans('New Request'),
            self::reserved => trans('Reserved'),
            self::on_way => trans('On Way'),
            self::delivered => trans('Delivered'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::new_request =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #ff8616">'
                .trans('New Request').'</span>',
            self::reserved =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #486bff">'
                .trans('Reserved').'</span>',
            self::on_way =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #34ff2c">'
                .trans('On Way').'</span>',
            self::delivered =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #ff0000">'
                .trans('Delivered').'</span>',
        ];
    }

}
