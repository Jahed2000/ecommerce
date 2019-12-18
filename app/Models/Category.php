<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent()
    {
    	return $this->belongsTo(Category::class,'parent_id');
    }

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

// checks if category is parent or child category from product_sidebar 
    public static function ParentOrNot( $child_id,$parent_id)
    {
    	$category = Category::where('id', $child_id)->where('parent_id',$parent_id)->get();
    	if (!is_null($category)) {
    		return true;
    	} else{
    		return false;
    	}
    }
}
