<?php

namespace common\enums;

class NewsType extends PhpEnum {

    const exhibtion = 1;
    const conferences = 2;
    const courses = 3;
    const offers = 4;

    public static function Labels() {
        return [
            self::exhibtion => t('Exhibtion'),
            self::conferences => t('Conferences'),
            self::courses => t('Courses'),
            self::offers => t('Offers'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::exhibtion => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #43b957">'.t('Exhibtion').'</span>',
            self::conferences => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #0049ff">' .t('Conferences').'</span>',
            self::courses => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #ffe909">' .t('Courses').'</span>',
            self::offers => '<span class=" badge badge-sm" style="color: white; font-size: 17px;background-color: #00ffbe">' .t('Offers').'</span>',
        ];
    }

}
