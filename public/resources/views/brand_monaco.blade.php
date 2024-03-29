@extends('layouts.front')

@section('title','Brands')


@section('content')
<img src="uploads/brands/1.jpg" class="brand_ppl" alt="">
<div class="productos">
    <ul class="migas">
        <li><a href="{{ route('brands') }}">Products</a></li>
        <li><a href="{{ route('brand_monaco') }}">Monaco</a></li>
    </ul>
    <ul class="lines">
        @foreach ($lines as $line)
            <li><a href="{{ route('change_line',$line->id) }}" @if($line->id == session('v_line_id')) class="activo" @endif>{{ $line->line_en }}</a></li>
        @endforeach
    </ul>
    <div class="caregories">
    @foreach ($catetories as $category)
        <a href="{{ route('category',$category->slug_en) }}">{{ $category->category_en }}</a>
    @endforeach
    </div>
    <div class="categories_2">
    @foreach ($catetories as $category)
        <article>
            <a href="{{ route('category',$category->slug_en) }}">
                <div style="background-image: url(uploads/categories/{{ $category->img }})"></div>
                <h4>{{ $category->category_en }}</h4>
            </a>
        </article>
    @endforeach
    </div>
    <div class="separador"></div>
</div>
@endsection

@section('javascript')

@endsection
