@extends('layouts.front')

@section('title','Brands')


@section('content')
<div class="productos">
    <div class="caregories_pl" style="background-image: @if($categories[0]->brand->type=='Private Label') url(uploads/brands/{{ $categories[0]->brand->img }}) @else url(uploads/other_brads/{{ $categories[0]->brand->img }}) @endif">
        <h1>Categories</h1>
        <a href="{{ route('brand',$categories[0]->brand->slug_en) }}" @if($slug_cat=="") class="activo" @endif>All</a>
    @foreach ($categories as $category)
        <a href="{{ route('brand',[$category->brand->slug_en, $category->slug_en]) }}" @if($category->slug_en==$slug_cat) class="activo" @endif>{{ $category->category_en }}</a>
    @endforeach
    </div>

    <div class="subcategories">
    @foreach ($categories2 as $category)
        <div class="separador"></div>
        <div class="sub_bloques">
            <h2>{{$category->category_en}}</h2>
        @foreach ($category->products_pl as $product)
            <article>
                <a href="{{ route('product',$product->slug_en) }}">
                    <div style="background-image: url(uploads/products/{{ $product->img }})"></div>
                    <h4>{{ $product->name_en }}</h4>
                    <h3>{{ $product->size }}</h3>
                </a>
            </article>
        @endforeach
            <div class="separador"></div>
            <a href="" class="subir">Subir</a>
        </div>
    @endforeach
    </div>
</div>

@endsection


@section('javascript')
<script>
    $(document).ready(function(){
        $('.subir').click(function(e){
            e.preventDefault();
            $('html,body').animate({scrollTop:0},1000, "easeOutQuad");
        })
    })
</script>
@endsection