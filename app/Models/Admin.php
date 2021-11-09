<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
        protected $fillable = [
        'fname' , 'lname' , 'phone' , 'num_del_ob ',
         'status' , 'password' , 'mobile_confirmed', 'isOnline'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
