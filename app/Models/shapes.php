<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shapes extends Model
{
    protected $table = "shapes";
    protected $guarded=[];

    public function medications()
    {
        return $this->belongsToMany('App\Models\medications','medication_shape');
    }

}
