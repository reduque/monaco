<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'lines';
	protected $guarded = ['id'];

	public function products(){
	    return $this->hasMany('App\Product');
	}
}
