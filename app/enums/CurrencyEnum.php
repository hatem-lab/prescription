<?php

namespace common\enums;

class CurrencyEnum extends PhpEnum {

    const syp = 1;

    public static function Labels() {
        return [
            self::syp => t('SYP'),
        ];
    }



}
