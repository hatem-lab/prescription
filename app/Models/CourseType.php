<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'courses_types';


    protected $guarded=[];
    public function scopeActive($query){
        return $query -> where('status',1) ;
    }
    public function getActive(){
        return  $this -> status  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }
    public function course()
    {
        return $this->hasMany('App\Models\Course','type_id');
    }



}
