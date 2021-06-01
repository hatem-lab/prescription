<?php

namespace App\enums;

use App\enums\PhpEnum;

class LoginApiEnum extends PhpEnum {

    const accepted = 1;
    const invalid_password = 2; //login failed
    const not_confirmed = 3; //needs phone confirmation
    const banned = 4; //lockout by system admin
    const not_active = 5; //account not active yet
    const not_found = 6; //account not found

    public static function Labels($lang = null) {
        return [
            self::accepted => trans('Login Accepted'),
            self::invalid_password => trans('Invalid Password'),
            self::not_confirmed => trans('Account not Confirmed'),
            self::banned => trans('User is BANNED'),
            self::not_active => trans( 'Account not Active'),
            self::not_found => trans( 'User not found'),
        ];
    }


}
