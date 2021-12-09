@extends('layouts.front')

@section('title','The Kitchen')


@section('content')
<section class="r_cat">
    <div class="bloque tabla">
        <div>
            <p>Do you want to make <br>something different for<br>dinner today?</p>
            <p>Are you having guests<br>over and don’t know what<br>to offer them?</p>
            <p>Or do you simply want<br>to enjoy something new<br>and delicious?</p>
            <span>Try out some our easy-to-prepare recipes<br>that will delight your palate.</span>
        </div>
    </div>
@foreach ($categories as $category)
    <div class="bloque" style="background-image: url(img/{{ $category->img }})">
        <a href="{{ route('recipes_category',$category->slug_en) }}" style="background: #{{ $category->color }}"><h2>{{ $category->category_en }}</h2></a>
    </div>
@endforeach
<div class="separador"></div>
</section>

@endsection
