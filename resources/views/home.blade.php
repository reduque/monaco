@extends('layouts.front')

@section('title','Home')


@section('content')
    <div class="fondonegro"></div>
    <section class="home_cuote">
        <p>We serve tables around the world with fine foods that bring flavor and delight to many meals</p>
    </section>
    <section class="banner_home1">
        <div class="o"></div>
        <div class="tapa"></div>
    </section>
    <section class="welcome_home">
        <div class="latas"></div>
        <h1>Welcome</h1>
        <p><b>OUR FEATURED PRODUCTS</b></p>
        <p>We offer an ample portfolio of premium<br>quality products, carefully selected to ensure<br>that each bite is beyond delicious</p>
    </section>
    <section class="banner_home_conteiner">
        <div class="banner_home2"><div class="contenedor"></div></div>
        <ul class="dots"></ul>
    </section>
    <section class="bloque4">
        <h3>FROM OUR KITCHEN</h3>
        <h2>Out of ideas for tonight’s supper?</h2>
        <p>We’ll be glad to give you a hand</p>
    </section>
    <section class="receta_home">
        <div class="textos bloque">
            <h2>THIS WEEK’S RECIPE</h2>
            <h3>{{ $recipe->title_en }}</h3>
            <div class="contenido"><?php
            $paso=0;
            foreach (explode("\n", $recipe->directions_en) as $line) {
                if (trim($line)) {
                    $paso++;
                    ?><div class="pasos elementos">{{ $paso }}</div><p class="line elementos">{!! $line !!}</p><?php
                }
            }?></div>
            <div class="botones">
                <div class="table">
                    <div class="tr">
                        <div class="td"><a class="a1" href="{{ route('recipes_category',$recipe->category->slug_en) }}#rep_{{ $recipe->id }}">FULL VIEW</a></div>
                        <div class="td"><a class="a2" href="{{ route('recipes') }}">SEE MORE</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="imagen bloque" style="background-image: url(uploads/recipes/{{ $recipe->picture }})"></div>
    </section>
    <section class="bloque5">
        <h2>Eating healthy Tip</h2>
        <p>{!! nl2br($tip->tip_en) !!}</p>
    </section>
    <div class="pallax"></div>
@endsection

@section('javascript')
<script>
    var ancho=$('.banner_home2').width();
    var b_act=0;

    $(document).ready(function(){
        var mover_banner=true;
        $(window).scroll(function(){
            var scrollTop = $(window).scrollTop();
            winh=$(window).height();
            if(scrollTop > ($('.banner_home1').offset().top - 250) && mover_banner){
                mover_banner=false;
                $('.o').animate({top:48},1500,"easeOutCubic");
            }
            obj=$('.pallax');
			mitop=obj.offset().top;
			mialto=obj.height();
			if((winh + scrollTop)>mitop && (scrollTop-mialto)<mitop){
				aa=winh+mialto;
				if(aa==0) aa=1;
				donde=(mitop-scrollTop-winh)*mialto/aa;
				obj.css("background-position","center " + donde + "px");
			}
        });
        $(window).resize(function(){
            ajustar();
        })
        ajustar();
    })
    function ajustar(){
        ancho=$('.banner_home2').width();
        $('.banner_home2 .contenedor a img').css('width', ancho);
        $('.banner_home2').css('height', 516 * ancho / 1024 );
        p=-b_act * ancho;
        $('.contenedor').css('left', p);
        cont_top=$('.contenido').offset().top;
        //receta
        mas=false;
        alto=0;
        // -49
        alto_texto=237;
        alti_linea=21;
        if(ancho<=783){
            alto_texto=351;
            alti_linea=23;
        }
        $('.elementos').each(function(){
            if( $(this).offset().top + $(this).height() - cont_top > alto_texto ){
                if(!mas){
                    if( $(this).hasClass('line') ){
                        alto=$('.contenido').height();
                        if(alto_texto-alto>alti_linea){
                            alto+=alti_linea;
                            $('.contenido').css('height', alto);
                        }
                    }
                }
                mas=true;
            }else{
                alto=$(this).offset().top + $(this).height() - cont_top - 2;
                $('.contenido').css('height', alto-2);
            }
        })
        if(mas){
            $('.textos').addClass('mas');
        }else{
            $('.textos').removeClass('mas');
        }
    }


    banners=[<?php
    $u='';
    foreach($banners as $banner){
        echo $u . '{img:"' . $banner->img_en . '", link:"' . $banner->link . '"}';
        $u=',';
    }
    ?>];
    var t;
    var mover=true;
    tot_banners=banners.length;
    $(window).load(function() {
        $('.contenedor').css("width", (tot_banners+1) * 1024);
        banners.forEach(function(banner){
            $('.contenedor').append('<a href="' + banner.link + '"><img src="uploads/banners/' + banner.img + '"></a>');
            $('.dots').append('<li></li>');
        });
        banner=banners[0];
        $('.contenedor').append('<a href="' + banner.link + '"><img src="uploads/banners/' + banner.img + '"></a>');
        $('.dots li:nth-child(1)').addClass('activo');
        t=setTimeout('f_mover_banner(1)', 3000);
        ajustar();
    })
    f_mover_banner=function(incremento){
        clearTimeout(t);
        b_act+=incremento;
        p=-b_act * ancho;
        $('.dots li').removeClass('activo');
        $('.contenedor').animate( {left: p },1500,"easeOutCubic", function(){
            if(b_act>=tot_banners){
                $('.contenedor').css('left',0);
                b_act=0;
            }
            $('.dots li:nth-child(' + (b_act+1) + ')').addClass('activo');
            if(mover) t=setTimeout('f_mover_banner(1)', 3000);
        });
    }
    $('.dots').on('click','li',function(){
        clearTimeout(t);
        b_act=$(this).index();
        f_mover_banner(0);
    })
    $('.banner_home2, .dots').mouseover(function(){
        mover=false;
        clearTimeout(t);
    }).mouseleave(function(){
        mover=true;
        t=setTimeout('f_mover_banner(1)', 1000);
    })
</script>
@endsection
