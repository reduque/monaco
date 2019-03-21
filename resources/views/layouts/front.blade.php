<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=640">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
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
                    <li><a href="">Products</a></li>
                    <li><a href="">Divisions</a></li>
                    <li><a href="">Eating Healthy</a></li>
                    <li><a href="">The Kitchen</a></li>
                    <li><a href="">Reach Us</a></li>
                </ul>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="footer1">
                <div class="floatd">
                    <a href="#" class="footer_reachus">Reach Us</a>
                    <p>1120 NW 165th Street, Miami, FL 33169<br>T  954  580 4400</p>
                    <p class="correo"><a href="#"><img src="img/email.gif" alt="Contact us"></a></p>
                </div>
            </div>
            <div class="footer2">
                <div class="floatd">
                    <div>
                        <ul>
                            <li><a href="" class="dorado">Our Story</a></li>
                            <li><a href="">A story of three pillars</a></li>
                            <li><a href="">Commitments</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="" class="dorado">Products</a></li>
                            <li><a href="">Beverages</a></li>
                            <li><a href="">Condiments & Spices</a></li>
                            <li><a href="">Dairy</a></li>
                            <li><a href="">Frozen</a></li>
                            <li><a href="">Fruits</a></li>
                            <li><a href="">Gourmet</a></li>
                            <li><a href="">Grain, Beans & Cereals</a></li>
                            <li><a href="">Oils & Vinegars</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="">Olives & Capers</a></li>
                            <li><a href="">Seafood</a></li>
                            <li><a href="">Seasonal</a></li>
                            <li><a href="">Vegetables</a></li>
                            <li>&nbsp;</li>
                            <li><a href="" class="dorado">Divisions</a></li>
                            <li><a href="">Food Service</a></li>
                            <li><a href="">Retail</a></li>
                            <li><a href="">Private Label</a></li>
                            <li><a href="">Industrial</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="" class="dorado">From Our Kitchen</a></li>
                            <li><a href="">Breakfast</a></li>
                            <li><a href="">Appetizers & Hors </a></li>
                            <li><a href="">d’Oeuvres</a></li>
                            <li><a href="">Main Course</a></li>
                            <li><a href="">Dessert</a></li>
                            <li><a href="">Beverages</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul>
                            <li><a href="" class="dorado">Eating Healthy</a></li>
                            <li><a href="">Tips for Eating Healthy</a></li>
                            <li>&nbsp;</li>
                            <li><a href="" class="dorado">Reach Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="separador"></div>
            </div>
        </footer>
        <div class="pie">
            <a href="">TERMS & CONDITIONS</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">PRIVACY STATEMENT</a>&nbsp;&nbsp;|&nbsp;&nbsp;©2017 MONACO FOODS INC. ALL RIGHTS RESERVED
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
