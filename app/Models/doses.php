<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doses extends Model
{
    protected $table = "doses";
    protected $guarded=[];
    public function medicationshapes()
    {
        return $this->belongsToMany('App\Models\MedicatiosShapes','medication_shapes_doses');
    }


}
