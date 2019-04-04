<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipesCategory extends Model
{
    protected $table = 'recipes_categories';
	protected $guarded = ['id'];

	public function recipes(){
		return $this->hasMany('App\Recipe','recipes_categories_id')->orderby('id','desc');
	}

}
