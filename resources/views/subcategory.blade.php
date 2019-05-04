@extends('layouts.front')

@section('title','Brands')


@section('content')
<div class="brand_ppl2">
    <img src="uploads/subcategories/{{ $subcategory->img }}" alt="{{ $subcategory->category->category_en }} - {{ $subcategory->subcategory_en }}">
</div>
<div class="productos">
    <ul class="migas">
        <li><a href="{{ route('brands') }}">Products</a></li>
        <li><a href="{{ route('brand_monaco') }}">Monaco</a></li>
        <li><a href="{{ route('category',$subcategory->category->slug_en) }}">{{ $subcategory->category->category_en }}</a></li>
        <li><a href="{{ route('subcategory',$subcategory->slug_en) }}">{{ $subcategory->subcategory_en }}</a></li>
    </ul>
    @include('partials._divisions')
    <div class="caregories">
        <h1>{{ $subcategory->subcategory_en }}</h1>
        <p>{!! nl2br($subcategory->description_en) !!}</p>
    </div>
    <div class="subcategories">
    @foreach ($subcategory->products as $product)
        <article>
            <a href="{{ route('product',$product->slug_en) }}">
                <div style="background-image: url(uploads/products/{{ $product->img }})"></div>
                <h4>{{ $product->name_en }}</h4>
                <h3>{{ $product->size }}</h3>
            </a>
        </article>
    @endforeach
        <div class="separadorv"></div>
    </div>
    <div class="separador"></div>
</div>
@endsection

@section('javascript')

@endsection
