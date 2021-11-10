<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';


    protected $guarded=[];
    public function scopeActive($query){
        return $query -> where('is_published',1) ;
    }
    public function getActive(){
        return  $this -> is_published  == 0 ?  'غير مفعل'   : 'مفعل' ;
    }

    public function medias()
    {
        return $this->hasMany('App\Models\Media','course_id');
    }




}
