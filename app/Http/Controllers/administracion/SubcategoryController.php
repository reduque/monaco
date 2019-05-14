<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Subcategory;
use App\Product;

class SubcategoryController extends Controller
{

    public function index(Request $request)
    {
        $subcategories=Subcategory::where('category_id',session('category_id'))->paginate(25);
        $category=Category::find(session('category_id'));
        return view('administracion.subcategories.index',['subcategories' => $subcategories, 'category' => $category]);
    }

    public function create()
    {
        $category=Category::find(session('category_id'));
        return view('administracion.subcategories.create',['category' => $category]);
    }

    public function store(Request $request)
    {
        $rules = [
            'subcategory_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $fileName = "";
            if($request->img){
                $fileName = $this->saveFile($request->img, 'subcategories/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $Subcategory=Subcategory::create([
                'category_id' => $request->category_id,
                'subcategory_en' => $request->subcategory_en,
                'slug_en' => str_slug($request->subcategory_en,"-"),
                'description_en' => $request->description_en,
                'img' => $fileName,
            ]);
            return redirect()->route('subcategories.edit', codifica($Subcategory->id))->with("notificacion", __('administracion.grabado_exito') );

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
        $subcategory=Subcategory::find($id);
        $category=Category::find(session('category_id'));
        $products=Product::where('subcategory_id',$id)->get();
        return view('administracion.subcategories.edit',['subcategory' => $subcategory, 'category' => $category, 'products' => $products]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'subcategory_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $Subcategory=Subcategory::find($id);
            $fileName = $Subcategory->img;
            if($request->img){
                if($fileName<>'')
                    $this->deleteFile('subcategories/' . $fileName);
                $fileName = $this->saveFile($request->img, 'subcategories/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $Subcategory->update([
                'subcategory_en' => $request->subcategory_en,
                'slug_en' => str_slug($request->subcategory_en,"-"),
                'description_en' => $request->description_en,
                'productoppal_id' => $request->productoppal_id,
                'img' => $fileName,
            ]);
            return redirect()->route('subcategories.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $Subcategory=Subcategory::find($id);
            $fileName = $Subcategory->img;
            if($fileName<>'')
                $this->deleteFile('subcategories/' . $fileName);

            $Subcategory->delete();
            return redirect()->route('subcategories.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}
