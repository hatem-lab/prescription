<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMobileEmail extends Model
{
    protected $table = 'user_mobile_email';
    public $timestamps = false;
    protected $fillable = [
        'mobile' , 'confirm_code' , 'is_confirmed',
        'is_primary' , 'type' , 'user_id'
    ];

    public function sendConfirmationCodePhone($type) {
//add Send SMS Here

        return true;
    }
}
