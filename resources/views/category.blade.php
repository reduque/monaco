@extends('layouts.front')

@section('title','Brands')


@section('content')
<h1 class="tit_cats">{{ $category->category_en }}</h1>
<div class="productos">
    <ul class="migas">
        <li><a href="{{ route('brands') }}">Products</a></li>
        <li><a href="{{ route('brand_monaco') }}">Monaco</a></li>
        <li><a href="{{ route('category',$category->slug_en) }}">{{ $category->category_en }}</a></li>
    </ul>
    <div class="subcat">
    @foreach ($category->subcategories as $subcategory)
        <article>
            <a href="{{ route('subcategory',$subcategory->slug_en) }}">
                <div @if ($subcategory->productoppal) style="background-image: url(uploads/products/{{ $subcategory->productoppal->img }})" @endif ></div>
                <h4>{{ $subcategory->subcategory_en }}</h4>
            </a>
        </article>
    @endforeach
        <div class="separador"></div>
    </div>


</div>
@endsection

@section('javascript')

@endsection
