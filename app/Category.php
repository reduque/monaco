<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
	protected $guarded = ['id'];

	public function subcategories(){
	    return $this->hasMany('App\Subcategory')->where('active',1);
	}

}
