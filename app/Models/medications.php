<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medications extends Model
{
    protected $table = "medications";
    protected $guarded=[];

    public function shapes()
    {
        return $this->belongsToMany('App\Models\shapes','medication_shape');
    }

    public function prescriptions()
    {
        return $this->belongsToMany('App\Models\Prescription','prescription_medication')->withPivot('precription_quantity','instruction_to_customer');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function contraindication()
    {
        return $this->belongsTo('App\Models\contraindications','contraindication_id');
    }

}
