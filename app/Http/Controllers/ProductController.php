<?php

namespace App\Http\Controllers;

use App\BannerBrand;
use App\OtherBrand;
use App\Line;
use App\Brand;
use App\Category;
use App\Subcategory;
use App\Product;
use Session;

class ProductController extends Controller
{
    public function brands()
    {
        $banners=BannerBrand::where('active',1)->get();
        $brands=Brand::where('id','<>',1)->get();
        $otherbrands=OtherBrand::get();
        return view('brands',['seccion' => 'products', 'banners' => $banners, 'otherbrands' => $otherbrands, 'brands' => $brands]);
    }
    

    public function brand_monaco()
    {
        $lines=Line::get();
        if(!Session::has('v_line_id')){
            session(['v_line_id' => $lines[0]->id]);
        }

        $catetories=Category::where('brand_id',1)->has('products')->get();
        return view('brand_monaco',['seccion' => 'products', 'lines' => $lines, 'catetories' => $catetories]);
    }
    public function change_line($id)
    {
        session(['v_line_id' => $id]);
        return redirect()->route('brand_monaco');
    }
    public function category($slug)
    {
        if(!Session::has('v_line_id')){
            return redirect()->route('brand_monaco');
        }
        $category=Category::where('brand_id',1)->where('slug_en',$slug)->first();
        return view('category',['seccion' => 'products', 'category' => $category]);
    }

    public function subcategory($slug)
    {
        if(!Session::has('v_line_id')){
            return redirect()->route('brand_monaco');
        }
        $lines=Line::get();
        $subcategory=Subcategory::where('slug_en',$slug)->first();
        return view('subcategory',['seccion' => 'products', 'lines' => $lines, 'subcategory' => $subcategory]);
    }

    public function product($slug)
    {
        $product=Product::where('slug_en',$slug)->first();
        return view('product',['seccion' => 'products', 'product' => $product]);
    }
    // otras marcas
    public function brand($slug)
    {
        if(!$brand=Brand::where('slug_en', $slug)->first()){
            return redirect()->route('brands');
        }
session(['v_line_id' => 1]);
$catetories2=Category::where('brand_id',1)->has('products')->get();
        $catetories=Category::where('brand_id',$brand->id)->get();
        return view('brand_pl',['seccion' => 'products', 'brand' => $brand, 'catetories' => $catetories, 'catetories2' => $catetories2]);
    }

}
