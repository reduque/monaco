@extends('layouts.front')

@section('title','Home')

@section('header')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
@endsection

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
    <section class="slick banner_home2">
        <a href=""><img src="uploads/banners/b1.png" alt=""></a>
        <a href=""><img src="uploads/banners/b2.png" alt=""></a>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
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
            //alert('tt');
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

        $('.slick').slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay:true,
        });
    })
</script>

@endsection
