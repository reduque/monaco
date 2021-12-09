@extends('layouts.front')

@section('title','Reach Us')


@section('content')
<section class="reachus">
    @if($notificacion=Session::get('notificacion'))
        <h1>Thank you<br>for your mail.<br>We will contact<br>you soon.</h1>
    @else

        <h1>Need to contact us?<br>Please do!</h1>
        <form role="form" action="{{ route('reach_us_enviar') }}" method="POST">
            {{ csrf_field() }}
            <div class="contenedor">
                <div class="col">
                    <div class="row{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        First name
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="row{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        Last name
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="row">
                        Company
                        <input type="text" name="company" value="{{ old('company') }}">
                    </div>
                    <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                        Email
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="row">
                        Country
                        <input type="text" name="country" value="{{ old('country') }}">
                    </div>
                    <div class="row{{ $errors->has('comment') ? ' has-error' : '' }}">
                        Comment
                        <textarea name="comment" required>{{ old('comment') }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <a class="mapa" href="https://www.google.com/maps/place/1120+NW+165th+St,+Miami,+FL+33169,+EE.+UU./@25.9240573,-80.2281638,3134m/data=!3m1!1e3!4m5!3m4!1s0x88d9ae4794df7075:0x8e0b52466ff5ad80!8m2!3d25.9240525!4d-80.2194087" target="_blank">&nbsp;</a>
                </div>
            </div>
            <div class="contenedor">
                <div class="col">
                    <button>SEND</button>
                </div>
                <div class="col">
                    <p class="direccion">1120 NW 165th Street, Miami, FL 33169<br>T  954  580 4400</p>
                    <div class="floati correo"><a href="#"><img src="img/email.gif" alt="Contact us"></a></div>
                    <ul>
                        <li><a href="" class="facebook"></a></li>
                        <li><a href="" class="instagram"></a></li>
                        <li><a href="" class="linkedin"></a></li>
                    </ul>
                </div>
            </div>
        </form>   
    @endif
</section>

@endsection
