<?php

namespace App\Http\Controllers\administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Subcategory;
use App\Line;
use App\Brand;
use Session;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if(!Session::has('q_category_id')){
            session(['q_category_id' => Category::first()->id]);
        }
        if($request->q){
            session(['q_category_id' => decodifica($request->q)]);
        }
        $categories=Category::get();
        $products=Product::where('category_id', session('q_category_id'))->paginate(25);
        return view('administracion.products.index',['products' => $products, 'categories' => $categories]);
    }

    public function create()
    {
        $category=Category::find(session('q_category_id'));
        $subcategories=Subcategory::where('category_id',session('q_category_id'))->get();
        $lines=Line::get();
        $brands=Brand::get();
        return view('administracion.products.create',['category' => $category,'subcategories' => $subcategories,'lines' => $lines,'brands' => $brands]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $img = "";
            if($request->img){
                $img = $this->saveFile($request->img, 'products/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $nutrition_facts='';
            if($request->nutrition_facts){
                $nutrition_facts = $this->saveFile2($request->file('nutrition_facts'), 'products/nf',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $spec_sheets='';
            if($request->spec_sheets){
                $spec_sheets = $this->saveFile2($request->file('spec_sheets'), 'products/ss',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $product=Product::create([
                'name_en' => $request->name_en,
                'slug_en' => str_slug($request->name_en,"-"),
                'description_en' => $request->description_en,
                'country' => $request->country,
                'size' => $request->size,
                'pack' => $request->pack,
                'ti_hi' => $request->ti_hi,
                'bar_code' => $request->bar_code,
                'shelf_life_en' => $request->shelf_life_en,
                'ingredients_en' => $request->ingredients_en,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'line_id' => $request->line_id,
                'img' => $img,
                'nutrition_facts' => $nutrition_facts,
                'spec_sheets' => $spec_sheets,
            ]);
            return redirect()->route('products.edit', codifica($product->id))->with("notificacion", __('administracion.grabado_exito') );

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
        $product=Product::find($id);

        $category=Category::find(session('q_category_id'));
        $subcategories=Subcategory::where('category_id',session('q_category_id'))->get();
        $lines=Line::get();
        $brands=Brand::get();
        return view('administracion.products.edit',['product' => $product,'category' => $category,'subcategories' => $subcategories,'lines' => $lines,'brands' => $brands]);


        return view('administracion.products.edit',['product' => $product]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name_en' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);
            $product=Product::find($id);

            $img = $product->img;
            if($request->img){
                if($img<>'') $this->deleteFile('products/' . $img);
                $img = $this->saveFile($request->img, 'products/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $nutrition_facts=$product->nutrition_facts;
            if($request->nutrition_facts){
                if($nutrition_facts<>'') $this->deleteFile('products/nf/' . $nutrition_facts);
                $nutrition_facts = $this->saveFile2($request->file('nutrition_facts'), 'products/nf/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }
            $spec_sheets=$product->spec_sheets;
            if($request->spec_sheets){
                if($spec_sheets<>'') $this->deleteFile('products/ss/' . $spec_sheets);
                $spec_sheets = $this->saveFile2($request->file('spec_sheets'), 'products/ss/',(string)(date("YmdHis")) . (string)(rand(1,9)));
            }

            $product->update([
                'name_en' => $request->name_en,
                'slug_en' => str_slug($request->name_en,"-"),
                'description_en' => $request->description_en,
                'country' => $request->country,
                'size' => $request->size,
                'pack' => $request->pack,
                'ti_hi' => $request->ti_hi,
                'bar_code' => $request->bar_code,
                'shelf_life_en' => $request->shelf_life_en,
                'ingredients_en' => $request->ingredients_en,
                'brand_id' => $request->brand_id,
                'subcategory_id' => $request->subcategory_id,
                'line_id' => $request->line_id,
                'img' => $img,
                'nutrition_facts' => $nutrition_facts,
                'spec_sheets' => $spec_sheets,
            ]);
            return redirect()->route('products.edit', codifica($id))->with("notificacion", __('administracion.grabado_exito') );

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            $product=Product::find($id);
            $img = $product->img;
            if($img<>'')
                $this->deleteFile('products/' . $img);

            $nutrition_facts = $product->nutrition_facts;
            if($nutrition_facts<>'')
                $this->deleteFile('products/nf/' . $nutrition_facts);

            $spec_sheets = $product->spec_sheets;
            if($spec_sheets<>'')
                $this->deleteFile('products/ss/' . $spec_sheets);

            $product->delete();
            return redirect()->route('products.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", __('administracion.error_eliminando') );
        }
    }
}
