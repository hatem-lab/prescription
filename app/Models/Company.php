<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $guarded=[];
    public function company_mediations()
    {
        return $this->hasMany('App\Models\medications','company_id');
    }

}
