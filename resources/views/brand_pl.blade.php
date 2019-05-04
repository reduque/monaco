@extends('layouts.front')

@section('title','Brands')


@section('content')
<div class="productos">
    <div class="caregories_pl" style="background-image: url(uploads/brands/{{ $brand->img }})">
        <h1>Categories</h1>
        <a href="" class="activo">All</a>
    @foreach ($catetories as $category)
        <a href="{{ route('category',$category->slug_en) }}">{{ $category->category_en }}</a>
    @endforeach
    </div>

    <div class="subcategories">
    @foreach ($catetories2 as $category)
        <div class="separador"></div>
        <div class="sub_bloques">
            <h2>{{$category->category_en}}</h2>
        @foreach ($category->products as $product)
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