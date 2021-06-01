<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMobileEmail extends Model
{
    protected $table = 'admin_mobile_email';
    public $timestamps = false;
    protected $fillable = [
        'mobile' , 'confirm_code' , 'is_confirmed',
        'is_primary' , 'type' , 'admin_id'
    ];

    public function sendConfirmationCodePhone($type) {
//add Send SMS Here

        return true;
    }
}
