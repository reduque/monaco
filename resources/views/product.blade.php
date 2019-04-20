@extends('layouts.front')

@section('title','Brands')


@section('content')
<h1 class="tit_cats">{{ $product->category->category_en }}</h1>
<div class="productos">
    <ul class="migas">
        <li><a href="{{ route('brands') }}">Products</a></li>
        <li><a href="{{ route('brand_monaco') }}">Monaco</a></li>
        <li><a href="{{ route('category',$product->category->slug_en) }}">{{ $product->category->category_en }}</a></li>
        <li><a href="{{ route('subcategory',$product->subcategory->slug_en) }}">{{ $product->subcategory->subcategory_en }}</a></li>
        <li><a href="{{ route('product',$product->slug_en) }}">{{ $product->name_en }}</a></li>
    </ul>
    <div class="product_single">
            {{ $product->subcategory->subcategory_en }}
        <div class="separador"></div>
    </div>


</div>
@endsection

@section('javascript')

@endsection
