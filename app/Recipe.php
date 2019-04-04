<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes';
	protected $guarded = ['id'];

    public function category(){
		return $this->belongsTo('App\RecipesCategory','recipes_categories_id');
	}
}
