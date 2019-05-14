<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
	protected $guarded = ['id'];

	public function brand(){
	    return $this->belongsTo('App\Brand');
	}
	public function subcategories(){
	    return $this->hasMany('App\Subcategory')->where('active',1);
	}
	public function subcategories_p(){
	    return $this->hasMany('App\Subcategory')->where('active',1)->has('products');
	}

	public function products(){
	    return $this->hasMany('App\Product')->where('line_id',session('v_line_id'));
	}

	public function products_pl(){
	    return $this->hasMany('App\Product');
	}

}
