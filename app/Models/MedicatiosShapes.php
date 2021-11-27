<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicatiosShapes extends Model
{
    protected $table = "medication_shape";
    protected $fillable=['medications_id','shape_id'];

    public function doses()
    {
        return $this->belongsToMany('App\Models\doses','medication_shapes_doses');
    }

}
