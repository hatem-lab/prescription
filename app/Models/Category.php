<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded=[];


    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
//   public function tags()
//    {
//        return $this->hasMany('App\Models\Tag','category_id');
//    }
    public function medications()
    {
        return $this->hasMany('App\Models\medications','category_id');
    }
}
