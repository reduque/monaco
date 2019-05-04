@extends('layouts.front')

@section('title','Brands')


@section('content')
<h1 class="tit_cats">{{ $product->category->category_en }}</h1>
<div class="productos sin_pie">
    <ul class="migas">
        <li><a href="{{ route('brands') }}">Products</a></li>
        <li><a href="{{ route('brand_monaco') }}">{{ $product->brand->brand_en }}</a></li>
        <li><a href="{{ route('category',$product->category->slug_en) }}">{{ $product->category->category_en }}</a></li>
        @if ($product->subcategory)
            <li><a href="{{ route('subcategory',$product->subcategory->slug_en) }}">{{ $product->subcategory->subcategory_en }}</a></li>
        @endif
        <li><a href="{{ route('product',$product->slug_en) }}">{{ $product->name_en }}</a></li>
    </ul>
    <div class="product_single">
        <div>
        @if ($product->img <> "")
            <img src="uploads/products/{{ $product->img }}" alt="{{ $product->name_en }}">
        @else        
            <img src="img/o_n.svg" alt="{{ $product->name_en }}" width="110">
        @endif
        </div>
        <div>
            <h1>{{ $product->name_en }}</h1>
            <table>
                <tr>
                    <td><strong>Brand</strong></td>
                    <td>{{ $product->brand->brand_en }}</td>
                </tr>
                <tr>
                    <td><strong>Country of Origin&nbsp;&nbsp;</strong></td>
                    <td>{{ $product->country }}</td>
                </tr>
                <tr>
                    <td><strong>Size</strong></td>
                    <td>{{ $product->size }}</td>
                </tr>
                <tr>
                    <td><strong>Pack</strong></td>
                    <td>{{ $product->pack }}</td>
                </tr>
                <tr>
                    <td><strong>Ti/Hi</strong></td>
                    <td>{{ $product->ti_hi }}</td>
                </tr>
                <tr>
                    <td><strong>Bar Code #</strong></td>
                    <td>{{ $product->bar_code }}</td>
                </tr>
                <tr>
                    <td><strong>Shelf Life</strong></td>
                    <td>{{ $product->shelf_life_en }}</td>
                </tr>
            </table>
            <h4>Ingredients </h4>
            <p>{{ $product->ingredients_en }}</p>
            @if($product->nutrition_facts . $product->spec_sheets <> '')
            <ul class="lines">
                @if($product->nutrition_facts <> '')
                    <li><a href="uploads/products/nf/{{ $product->nutrition_facts }}" target="_blank">NUTRITION FACTS</a></li>
                @endif
                @if($product->spec_sheets <> '')
                    <li><a href="uploads/products/ss/{{ $product->spec_sheets }}" target="_blank">SPEC SHEET</a></li>
                @endif
            </ul>
            @endif
        </div>
    </div>
</div>
<div class="pie_prod">
    <div class="fondo"></div>
    <ul>
        <li><a href="{{ route('brands') }}">
            <div class="imagen" style="background-image: url(img/p1.jpg)"></div>
            <div class="texto">
                <h3>Products</h3>
                <p>Learn more</p>
            </div>
        </a></li>
        <li><a href="{{ route('tips') }}">
            <div class="imagen" style="background-image: url(img/p2.jpg)"></div>
            <div class="texto">
                <h3>Tips</h3>
                <p>Learn more</p>
            </div>
        </a></li>
        <li><a href="{{ route('recipes') }}">
            <div class="imagen" style="background-image: url(img/p3.jpg)"></div>
            <div class="texto">
                <h3>Recipies</h3>
                <p>Learn more</p>
            </div>
        </a></li>
    </ul>
    <div class="separador"></div>
</div>
@endsection

@section('javascript')

@endsection
