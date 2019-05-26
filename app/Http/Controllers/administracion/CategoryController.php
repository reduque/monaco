<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Brand;
use Session;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if(!Session::has('q_brand_id')){
            session(['q_brand_id' => Brand::first()->id]);
        }
        if($request->q){
            session(['q_brand_id' => decodifica($request->q)]);
        }
        $brands=Brand::get();
        $categories=Category::where('brand_id',session('q_brand_id'))->paginate(25);
        return view('administracion.categories.index',['categories' => $categories, 'brands' => $brands]);
    }

    public function create()
    {
        return view('administracion.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'category_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $fileName = "";
            if($request->img){
                $fileName = $this->saveFile($request->img, 'categories/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $category=Category::create([
                'category_en' => $request->category_en,
                'category_es' => $request->category_es,
                'slug_en' => str_slug($request->category_en,"-"),
                'slug_es' => str_slug($request->category_es,"-"),
                'brand_id' => session('q_brand_id'),
                'img' => $fileName,
            ]);
            return redirect()->route('categories.edit', codifica($category->id))->with("notificacion", __('administracion.grabado_exito') );

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
        $category=Category::find($id);
        session(['category_id' => $id]);
        return view('administracion.categories.edit',['category' => $category]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'category_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $category=Category::find($id);
            $fileName = $category->img;
            if($request->img){
                if($fileName<>'')
                    $this->deleteFile('categories/' . $fileName);
                $fileName = $this->saveFile($request->img, 'categories/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $category->update([
                'category_en' => $request->category_en,
                'category_es' => $request->category_es,
                'slug_en' => str_slug($request->category_en,"-"),
                'slug_es' => str_slug($request->category_es,"-"),
                'brand_id' => session('q_brand_id'),
                'img' => $fileName,
            ]);
            return redirect()->route('categories.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $category=Category::find($id);
            $fileName = $category->img;
            if($fileName<>'')
                $this->deleteFile('categories/' . $fileName);

            $category->delete();
            return redirect()->route('categories.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}
