<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
	protected $guarded = ['id'];

    public function productoppal(){
	    return $this->belongsTo('App\Product','productoppal_id');
	}

	public function products(){
	    return $this->hasMany('App\Product')->where('line_id',session('v_line_id'));
	}

	public function category(){
	    return $this->belongsTo('App\Category');
	}

}
