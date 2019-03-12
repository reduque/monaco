@extends('layouts.front')

@section('title','Home')


@section('content')

    <section class="home_cuote">
        <p>We serve tables around the world with fine foods that bring flavor and delight to many meals.</p>
    </section>
    <section class="banner_home1">
        <div class="o"></div>
        <div class="tapa"></div>
    </section>
    <section class="welcome_home">
        <div class="latas"></div>
        <h1>Welcome</h1>
        <p><b>OUR FEATURED PRODUCTS</b></p>
        <p>We offer an ample portfolio of premium<br>quality products, carefully selected to ensure<br>that each bite is beyond delicious.</p>

    </section>
    <section class="banner_home2">
        <div class="contenedor"></div>
        <ul class="dots"></ul>
    </section>
    <section class="bloque4">
        <h3>FROM OUR KITCHEN</h3>
        <h2>Out of ideas for tonight supper?</h2>
        <p>We’ll be glad to give you a hand</p>
    </section>
    <section class="receta_home">
        <div class="textos bloque">
            <h2>THIS WEEK’S RECIPE</h2>
            <!-- contenido dinámico -->
            <h3>Quinoa Veggie Burgers</h3>
            <div class="pasos">1</div>
            <p>Chop your mushrooms in a food processor and reserve. </p>
            <div class="pasos">2</div>
            <p>Process the zucchini and dry excess liquid with paper towels and add to mushrooms</p>
            <div class="pasos">3</div>
            <p>Add oil to skillet, heat and sauté onions and yellow pepper paste until softened.</p>
            <div class="botones">
                <div class="table">
                    <div class="tr">
                        <div class="td"><a class="a1" href="">FULL VIEW</a></div>
                        <div class="td"><a class="a2" href="">SEE MORE RECIPEES</a></div>
                    </div>
                </div>
            </div>
            <!-- contenido dinámico -->
        </div>
        <div class="imagen bloque" style="background-image: url(uploads/recetas/r1.jpg)"></div>
    </section>
    <section class="bloque5">
        <h2>Eating healthy Tip</h2>
        <p>It is said that the name Balsamic comes from the healing element balm, as it was believed that Balsamic <br>
        Vinegar was a healing aid centuries ago. <br>
        Balsamic Vinegar has antioxidants that improve<br> 
        the immune system, guarding from free radicals that damage your cells.  It can also protect against <br>
        heart disease and cancer.</p>
    </section>
    <div class="pallax"></div>
@endsection

@section('javascript')
    <script>
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
    })
    banners=[<?php
    $u='';
    foreach($banners as $banner){
        echo $u . '{img:"' . $banner->img_en . '", link:"' . $banner->link . '"}';
        $u=',';
    }
    ?>];
    var t;
    var ancho=$('.banner_home2').width();
    var b_act=0;
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
        t=setTimeout(mover_banner, 3000);
    })
    mover_banner=function(){
        clearTimeout(t);
        b_act++;
        p=-b_act * ancho;
        $('.dots li').removeClass('activo');
        $('.contenedor').animate( {left: p },1500,"easeOutCubic", function(){
            if(b_act>=tot_banners){
                $('.contenedor').css('left',0);
                b_act=0;
            }
            $('.dots li:nth-child(' + (b_act+1) + ')').addClass('activo');
            if(mover) t=setTimeout(mover_banner, 3000);
        });
    }
    $('.dots').on('click','li',function(){
        clearTimeout(t);
        b_act=$(this).index()-1;
        mover_banner();
    })
    $('.banner_home2').mouseover(function(){
        mover=false;
        clearTimeout(t);
    }).mouseleave(function(){
        mover=true;
        t=setTimeout(mover_banner, 1000);
    })
</script>
@endsection
