<?php

namespace App\enums;

class NotificationType extends PhpEnum
{
    const NEW_ORDER = 1;
    const NEW_OFFER = 2;
    const DELETE_OFFER = 3;

    public static function Labels($lang = null)
    {
        return [
            self::NEW_ORDER => trans( 'New Order'),
            self::NEW_OFFER => trans('New Offer'),
            self::DELETE_OFFER => trans('Delete Offer'),

        ];
    }

    public static function UserNotifications($lang = null)
    {
        return [
            self::NEW_OFFER => trans('New Offer'),
            self::DELETE_OFFER => trans('Delete Offer'),

        ];
    }

    public static function AdminNotifications($lang = null)
    {
        return [
            self::NEW_ORDER => trans('New Order'),
        ];
    }


}
