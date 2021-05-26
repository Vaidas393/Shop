<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
      return $this->hasMany('App\Category', 'parent_id')->where('status',1);
    }

    // to display relashionships in category table
    public function section(){
      return $this->belongsTo('App\Section','section_id')->select('id','name');
    }

    // to display relashionships in category table
    public function parentcategory(){
      return $this->belongsTo('App\Category','parent_id')->select('id','category_name');
    }
}
