<?php

namespace App\Http\Controllers;

use App\BannerBrand;
use App\OtherBrand;
use App\Line;
use App\Category;
use App\Subcategory;
use App\Product;

class ProductController extends Controller
{
    public function brands()
    {
        $banners=BannerBrand::where('active',1)->inRandomOrder()->get();
        $otherbrands=OtherBrand::get();
        return view('brands',['seccion' => 'products', 'banners' => $banners, 'otherbrands' => $otherbrands]);
    }
    

    public function brand_monaco()
    {
        $lines=Line::get();
        $catetories=Category::get();
        return view('brand_monaco',['seccion' => 'products', 'lines' => $lines, 'catetories' => $catetories]);
    }

    public function category($slug)
    {
        $category=Category::where('slug_en',$slug)->first();
        return view('category',['seccion' => 'products', 'category' => $category]);
    }

    public function subcategory($slug)
    {
        $lines=Line::get();
        $subcategory=Subcategory::where('slug_en',$slug)->first();
        return view('subcategory',['seccion' => 'products', 'lines' => $lines, 'subcategory' => $subcategory]);
    }

    public function product($slug)
    {
        $product=Product::where('slug_en',$slug)->first();
        return view('product',['seccion' => 'products', 'product' => $product]);
    }
}
