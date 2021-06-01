<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends \TCG\Voyager\Models\User implements JWTSubject
{
    const image_directory = 'admins';


    /*
       * @var array
    */
    protected $fillable = [
        'fname' , 'lname' , 'phone' , 'num_del_ob ',
         'status' , 'password' , 'mobile_confirmed', 'isOnline'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function car_type() {
        return $this->belongsTo(CarType::class , 'car_type_id');
    }

    public function region() {
        return $this->belongsTo(Region::class , 'region_id');
    }

    public function offers() {
        return $this->hasMany(Offer::class , 'admin_id');
    }

}
