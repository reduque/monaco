@extends('layouts.front')

@section('title','The Kitchen - ' . $category->category_en)


@section('content')
<section class="recipes_header">
    <div class="contenedor">

        <ul class="categories">
            @foreach ($categories as $category_h)
                <li><a href="{{ route('recipes_category',$category_h->slug_en) }}" @if($category_h->id == $category->id) class="activo" @endif>{{ $category_h->category_en }}</a></li>
            @endforeach
        </ul>
        <div class="lista_r">
        @foreach ($category->recipes as $recipe)
            <div><a href="" data-id="{{ $recipe->id }}">{{ $recipe->title_en }}</a></div>
        @endforeach
        </div>
        @if ($category->recipes->count() > 5)
        <div class="see_more_contenedor"><a href="" class="see_more">SEE MORE</a></div>
        <a href="" class="x">Close</a>
        @endif
    </div>
</section>
<section class="recipes_body">
@foreach ($category->recipes as $recipe)
    <article>
        <div id="rep_{{ $recipe->id }}" class="ancla"></div>
        <div class="foto" style="background-image:url(uploads/recipes/{{ $recipe->picture }})"></div>
        <div class="contenido" style="background: #{{ $category->color }}">
            <h1>{{ $recipe->title_en }}</h1>
            <h2>Ingredients</h2>
            <div class="palito"></div>
            <div class="textos">
                <div class="ingredientes">{!! nl2br($recipe->ingredients_en) !!}</div>
            </div>
            <div class="see_more_contenedor"><a href="" class="see_more">SEE MORE</a></div>
            
            <div class="info"><b>SERVES </b>{{ $recipe->serves_en }}&nbsp;&nbsp;|&nbsp;&nbsp;<b>TIME </b>{{ $recipe->time_en }}</div>
        </div>
        <div class="mas_info" style="background: #{{ $category->color }}">
            <div class="mas_info2">
                <div class="textos">
                    <div class="ingredientes">{!! nl2br($recipe->ingredients_en) !!}</div>
                </div>
            </div>
            <a href="" class="x">Close</a>
        </div>
        <div class="indicaciones">
            <h2>Directions</h2>
            <div class="palito"></div>
            <ul>
            <?php $salto=''; ?>
            @foreach (explode("\n", $recipe->directions_en) as $direction)
                <li @if(substr($direction,0,3) <> '<b>') class="cb" @endif> @if(substr($direction,0,3) == '<b>') {!! $salto !!} @endif{!! $direction !!}</li><?php $salto='<br>'; ?>
            @endforeach
            </ul>
            <a href="" class="subir">Subir</a>
        </div>
    </article>
@endforeach
    <div class="separador"></div>
</section>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        $('.recipes_body .see_more').click(function(e){
            e.preventDefault();
            obj=$(this).parents('article');
            obj.find('.foto').addClass('invisible');
            obj.find('.contenido').addClass('izquierda');
            obj.find('.mas_info').addClass('visible');
            obj.find('.see_more').addClass('invisible');
        })
        $('.recipes_body .x').click(function(e){
            e.preventDefault();
            obj=$(this).parents('article');
            obj.find('.foto').removeClass('invisible');
            obj.find('.contenido').removeClass('izquierda');
            obj.find('.mas_info').removeClass('visible');
            obj.find('.see_more').removeClass('invisible');
        })


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
            $('html,body').animate({scrollTop:$("#rep_" + $(this).data('id')).offset().top},1000, "easeOutQuad");
        })
        $('.subir').click(function(e){
            e.preventDefault();
            $('html,body').animate({scrollTop:0},1000, "easeOutQuad");
        })
    })
</script>
@endsection