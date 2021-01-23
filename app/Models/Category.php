<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent(){
    	return $this->belongsTo(Category::class, 'parent_id');
    } 
    
    public function products(){
    	return $this->hasMany(Product::class);
    } 

   //check is the category child category of that parent category 
    public static function ParentOrNotCategory($main_id, $sub_id){
    	$categories = Category::where('id', $sub_id)->where('parent_id', $main_id)->get();
    	if(!is_null($categories)){
    		return true;
    	}
    	else{
    		return false;
    	}
    }    
}
