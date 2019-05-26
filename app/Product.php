<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
	protected $guarded = ['id'];

	public function category(){
	    return $this->belongsTo('App\Category');
	}
	public function subcategory(){
	    return $this->belongsTo('App\Subcategory');
	}
	public function brand(){
	    return $this->belongsTo('App\Brand');
	}
	public function line(){
	    return $this->belongsTo('App\Line');
	}
	
	public function relacionado(){
	    return $this->hasOne('App\RelatedProduct','related_id')->where('related_products.product_id',session('product_id'));
	}

	public function scopeBuscar($query, $filtro){
		if($filtro <> ''){
			$query->where("name_en","like","%" . $filtro . "%");
		}
	}


}
