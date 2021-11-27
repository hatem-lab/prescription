<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = "prescriptions";
    protected $guarded=[];

    public function medications_prescription()
    {
        return $this->belongsToMany('App\Models\medications','prescription_medication')->withPivot('precription_quantity','instruction_to_customer');
    }
}
