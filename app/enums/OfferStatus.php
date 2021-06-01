<?php

namespace App\enums;

class OfferStatus extends PhpEnum {

    const new_offer = 1;
    const accepted = 2;
    const rejected = 3;

    public static function Labels() {
        return [
            self::new_offer=> trans('New Offer'),
            self::accepted => trans('Accepted'),
            self::rejected => trans('Rejected'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::new_offer =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #ff8616">'
                .trans('New Offer').'</span>',
            self::accepted =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #486bff">'
                .trans('Accepted').'</span>',
            self::rejected =>
                '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #34ff2c">'
                .trans('Rejected').'</span>',

        ];
    }

}
