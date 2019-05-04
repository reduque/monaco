<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=640">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet"> -->
    <base href="{{ asset('/') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <!-- Styles -->
    @yield('header')
    <link href="css/main.css?v?{{ rand() }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("/favicon/apple-touch-icon.png") }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("/favicon/favicon-32x32.png") }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("/favicon/favicon-16x16.png") }}">
    <link rel="manifest" href="{{ asset("/favicon/site.webmanifest") }}">
    <link rel="mask-icon" href="{{ asset("/favicon/safari-pinned-tab.svg") }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
    <div class="cuerpo">
        <header>
            <div class="tabla">
                <ul>
                    <li><a href="" class="menu">Menu</a></li>
                    <li class="logo"><a href="{{ route('home') }}" title="Monaco"><img src="img/logo.svg" alt="Monaco"></a> </li>
                    <li><a href="" class="lupa">Search</a></li>
                </ul>
            </div>
            <nav>
                <a href="" class="cerrar_hamburguesa">Cerrar</a>
                <ul>
                    <li><a @if($seccion=='home') class="activo" @endif href="{{ route('home') }}">Home</a></li>
                    <li><a @if($seccion=='our_story') class="activo" @endif href="{{ route('our_story') }}">Our Story</a></li>
                    <li><a @if($seccion=='products') class="activo" @endif href="{{ route('brands') }}">Products</a></li>
                    <li><a @if($seccion=='divisions') class="activo" @endif href="{{ route('divisions') }}">Divisions</a></li>
                    <li><a @if($seccion=='tips') class="activo" @endif href="{{ route('tips') }}">Eating Healthy</a></li>
                    <li><a @if($seccion=='recipes') class="activo" @endif href="{{ route('recipes') }}">The Kitchen</a></li>
                    <li><a @if($seccion=='reach_us') class="activo" @endif href="{{ route('reach_us') }}">Reach Us</a></li>
                </ul>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
        @if($seccion <> 'reach_us')
            @include('partials._footer')
        @else
            <div class="footer_ru"></div>
        @endif
            <div class="footer2">
                <div class="floatd">
                    <div>
                        <ul>
                            <li><a href="{{ route('our_story') }}" class="dorado">Our Story</a></li>
                            <li><a href="{{ route('our_story') }}">A story of three pillars</a></li>
                            <li><a href="{{ route('our_story') }}#commitments">Commitments</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('brands') }}" class="dorado">Products</a></li>
                            <li><a href="{{ route('brands') }}#brand_monaco">Monaco</a></li>
                            <li><a href="{{ route('brands') }}#private_label">Private Label</a></li>
                            <li><a href="{{ route('brands') }}#other_brands">Other Brands</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('divisions') }}" class="dorado">Divisions</a></li>
                            <li><a href="{{ route('change_line',3) }}">Food Service</a></li>
                            <li><a href="{{ route('change_line',1) }}">Retail</a></li>
                            <li><a href="{{ route('brands') }}#private_label">Private Label</a></li>
                            <li><a href="{{ route('change_line',4) }}">Industrial</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="{{ route('recipes') }}" class="dorado">From Our Kitchen</a></li>
                            <li><a href="{{ route('recipes_category','breakfast') }}">Breakfast</a></li>
                            <li><a href="{{ route('recipes_category','appetizers-hors-doeuvres') }}">Appetizers & Hors d’Oeuvres</a></li>
                            <li><a href="{{ route('recipes_category','main-course') }}">Main Course</a></li>
                            <li><a href="{{ route('recipes_category','desserts') }}">Dessert</a></li>
                            <li><a href="{{ route('recipes_category','beverages') }}">Beverages</a></li>
                        </ul>
                        <ul>
                            <li><a href="{{ route('tips') }}" class="dorado">Eating Healthy</a></li>
                            <li><a href="{{ route('tips') }}">Tips for Eating Healthy</a></li>
                            <li>&nbsp;</li>
                            <li><a href="{{ route('reach_us') }}" class="dorado">Reach Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="separador"></div>
            </div>
        </footer>
        <div class="pie">
            <a href="{{ route('tyc') }}">TERMS & CONDITIONS</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('tyc') }}">PRIVACY STATEMENT</a>&nbsp;&nbsp;|&nbsp;&nbsp;©2017 MONACO FOODS INC. ALL RIGHTS RESERVED
        </div>
    </div>


    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/modernizr-3.5.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('header .menu').click(function(e){
                e.preventDefault();
                $('header nav').slideDown(500);
            })
            $('header .cerrar_hamburguesa').click(function(e){
                e.preventDefault();
                $('header nav').slideUp(500);
            })
            $('.correo a').click(function(e){
                e.preventDefault();
                $.get( "{{ route('contact') }}", function( data ) {
                    document.location=data;
                });
            })
        })
    </script>
    @yield('javascript')
</body>
</html>
