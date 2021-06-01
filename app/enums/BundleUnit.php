<?php

namespace common\enums;

class BundleUnit extends PhpEnum {

    const per_month = 1;

    public static function Labels() {
        return [
            self::per_month => t('per Month'),
        ];
    }



}
