<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\RecipesCategory;
use App\Recipe;

class RecipeController extends Controller
{

    public function index()
    {
        $recipes=Recipe::paginate(25);
        return view('administracion.recipes.index',['recipes' => $recipes]);
    }

    public function create()
    {
        return view('administracion.recipes.create',['categories' => RecipesCategory::get()]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $slug_en=str_slug($request->title_en,"-");
            $slug_es=str_slug($request->title_es,"-");
            $fileName = "";
            if($request->picture){
                $fileName = $this->saveFile($request->picture, 'recipes/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            if(!$request->active) $request->request->add(['active' => 0]);
            $recipe=Recipe::create([
                'title_en' => $request->title_en,
                'slug_en' => $slug_en,
                'ingredients_en' => $request->ingredients_en,
                'directions_en' => $request->directions_en,
                'serves_en' => $request->serves_en,
                'time_en' => $request->time_en,
                'title_es' => $request->title_es,
                'slug_es' => $slug_es,
                'ingredients_es' => $request->ingredients_es,
                'directions_es' => $request->directions_es,
                'serves_es' => $request->serves_es,
                'time_es' => $request->time_es,
                'recipes_categories_id' => $request->recipes_categories_id,
                'picture' => $fileName,
                'publication_date' => $request->publication_date,
                'active' => $request->active,
            ]);
            return redirect()->route('recipes.edit', codifica($recipe->id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id=decodifica($id);
        $recipe=Recipe::find($id);
        session(['project_id' => $id]);
        return view('administracion.recipes.edit',['recipe' => $recipe, 'categories' => RecipesCategory::get()]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'title_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $recipe=Recipe::find($id);
            $slug_en=str_slug($request->title_en,"-");
            $slug_es=str_slug($request->title_es,"-");
            $fileName = $recipe->picture;
            if($request->picture){
                if($fileName<>'')
                    $this->deleteFile('recipes/' . $fileName);
                $fileName = $this->saveFile($request->picture, 'recipes/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            if(!$request->active) $request->request->add(['active' => 0]);
            $recipe->update([
                'title_en' => $request->title_en,
                'slug_en' => $slug_en,
                'ingredients_en' => $request->ingredients_en,
                'directions_en' => $request->directions_en,
                'serves_en' => $request->serves_en,
                'time_en' => $request->time_en,
                'title_es' => $request->title_es,
                'slug_es' => $slug_es,
                'ingredients_es' => $request->ingredients_es,
                'directions_es' => $request->directions_es,
                'serves_es' => $request->serves_es,
                'time_es' => $request->time_es,
                'recipes_categories_id' => $request->recipes_categories_id,
                'picture' => $fileName,
                'publication_date' => $request->publication_date,
                'active' => $request->active,
            ]);
            return redirect()->route('recipes.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $recipe=Recipe::find($id);
            $fileName = $recipe->picture;
            if($fileName<>'')
                $this->deleteFile('recipes/' . $fileName);

            $recipe->delete();
            return redirect()->route('recipes.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}
