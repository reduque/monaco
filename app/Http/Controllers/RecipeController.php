<?php

namespace App\Http\Controllers;

use App\RecipesCategory;
use App\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $categories=RecipesCategory::get();
        return view('recipes_categories',['seccion' => 'recipes', 'categories' => $categories]);
    }
    public function category($slug)
    {
        $category=RecipesCategory::where('slug_en',$slug)->first();
        return view('recipes',['seccion' => 'recipes', 'category' => $category]);
    }
}
