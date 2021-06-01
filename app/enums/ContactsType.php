<?php

namespace common\enums;

class ContactsType extends PhpEnum {

    const customs_broker = 1;
    const economic_consultant = 2;

    public static function Labels() {
        return [
            self::customs_broker => t('Customs Broker'),
            self::economic_consultant => t('Economic Consultant'),
        ];
    }

    public static function LabelsStyle() {
        return [
            self::customs_broker => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #1212b9">' .t('Customs Broker').'</span>',
            self::economic_consultant => '<span class=" badge badge-sm" style="color: white;font-size: 17px; background-color: #08ff42">' .t('Economic Consultant').'</span>',
        ];
    }

}
