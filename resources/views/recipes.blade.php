@extends('layouts.front')

@section('title','The Kitchen - ' . $category->category_en)


@section('content')
<section class="recipes_header">
    <div class="contenedor">
        <h1>{{ $category->category_en }}</h1>
        <div class="lista_r">
        @foreach ($category->recipes as $recipe)
            <div><a href="" data-id="{{ $recipe->id }}">{{ $recipe->title_en }}</a></div>
        @endforeach
        </div>
        @if ($category->recipes->count() > 5)
        <div class="see_more_contenedor"><a href="" class="see_more">SEE MORE</a></div>
        <a href="" class="x">SEE MORE</a>
        @endif
    </div>
</section>
<section class="recipes_body">
@foreach ($category->recipes as $recipe)
    <article id="rep_{{ $recipe->id }}">
        <div class="foto" style="background-image:url(uploads/recipes/{{ $recipe->picture }})"></div>
        <div class="contenido" style="background: #{{ $category->color }}">
            <h1>{{ $recipe->title_en }}</h1>
        </div>
    </article>
@endforeach
    <div class="separador"></div>
</section>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('.recipes_header .see_more').click(function(e){
            e.preventDefault();
            $('.recipes_header .lista_r').animate({height: '{{36 * $category->recipes->count()}}px'},500);
            $(this).fadeOut(250);
            $('.recipes_header .x').fadeIn(500);
        })
        $('.recipes_header .x').click(function(e){
            e.preventDefault();
            $('.recipes_header .lista_r').animate({height: '180px'},500);
            $(this).fadeOut(250);
            $('.recipes_header .see_more').fadeIn(500);
        })
        $('.recipes_header .lista_r a').click(function(e){
            e.preventDefault();
            $('html,body').animate({scrollTop:$("#rep_" + $(this).data('id')).offset().top - 83},1000, "easeOutQuad");
        })
    })
</script>
@endsection