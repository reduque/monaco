@extends('layouts.front')

@section('title','Brands')


@section('content')
    <div class="fondonegro"></div>
    <section class="banner_home_conteiner">
        <div class="banner_home2"><div class="contenedor"></div><div class="tapa"></div></div>
        <ul class="dots"></ul>
    </section>


    <section class="brands1">
        <div class="ancla" id="brand_monaco"></div>
        <h1>Our Brand</h1>
        <a href="{{ route('brand_monaco') }}" class="aumentar">Monaco</a>
    </section>
    <section class="brands2">
        <div class="ancla" id="private_label"></div>
        <h2>Private Label</h2>
        <div class="other">
            @foreach ($brands as $brand)
                <a href="{{ route('brand',$brand->slug_en) }}" style="background-image: url(uploads/brands/{{ $brand->img}})" class="aumentar">{{ $brand->brand_en}}</a>
            @endforeach
        </div>
    </section>
    <section class="brands3">
        <div class="ancla" id="other_brands"></div>
        <h2>Other Brands</h2>
        @php
            $medio=ceil($otherbrands->count()/2);
            $act=1;
        @endphp
        <div>
            <ul>
            @foreach ($otherbrands as $brand)
                <li><a href="{{ route('brand',[$brand->slug_en]) }}" data-img="{{ $brand->img }}">{{ $brand->brand_en }}</a></li>
                @php
                if($act == $medio) echo "</ul></div><div><ul>";
                $act++;
                @endphp
            @endforeach
            </ul>
        </div>
        <div class="sello"><img src="img/nada.gif" id="sello" style="max-height: {{ 35 + (35 * $medio) }}px"></div>
    </section>
    <div class="separadorv"></div>
@endsection

@section('javascript')
<script>
    var ancho=$('.banner_home2').width();
    var b_act=0;

    $(document).ready(function(){
        $(window).resize(function(){
            ajustar();
        })
        ajustar();
        $('.brands3 a').mouseover(function(){
            if($(this).data('img') != ""){
                $('#sello').attr('src', 'uploads/other_brads/' + $(this).data('img'));
            }else{
                $('#sello').attr('src', 'img/nada.gif');
            }
        }).mouseleave(function(){
            $('#sello').attr('src', 'img/nada.gif');
        })
    })
    function ajustar(){
        ancho=$('.banner_home2').width();
        $('.banner_home2 .contenedor a img').css('width', ancho);
        $('.banner_home2').css('height', 516 * ancho / 1024 );
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
            $('.contenedor').append('<a href="' + banner.link + '"><img src="uploads/banners_brands/' + banner.img + '"></a>');
            $('.dots').append('<li></li>');
        });
        banner=banners[0];
        $('.contenedor').append('<a href="' + banner.link + '"><img src="uploads/banners_brands/' + banner.img + '"></a>');
        $('.dots li:nth-child(1)').addClass('activo');
        $('.tapa').addClass('activo');
        t=setTimeout('f_mover_banner(1)', 3000);
        ajustar();
    })
    f_mover_banner=function(incremento){
        clearTimeout(t);
        delay=0;
        if(incremento==1 && b_act==0){
            delay=500;
        }
        b_act+=incremento;
        p=-b_act * ancho;
        $('.dots li').removeClass('activo');
        $('.tapa').removeClass('activo');

        $('.contenedor').delay(delay).animate( {left: p },1500,"easeOutCubic", function(){
            if(b_act>=tot_banners){
                $('.contenedor').css('left',0);
                b_act=0;
            }
            $('.dots li:nth-child(' + (b_act+1) + ')').addClass('activo');
            if(b_act==0){
                $('.tapa').addClass('activo');
            }
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
