@extends('layouts.front')

@section('title','Eating Healthy Tips')


@section('content')

<section class="tips">
    <div class="banner">
        <h1>Tips for <br class="enter">Eating Healthy</h1>
    </div>
    <div class="contenedor">
        @php
            $tot=ceil($tips->count()/2);
        @endphp
        <div class="floati">
        @foreach ($tips as $step => $tip)
            @if($tot == $step) </div><div class="floatd"> @endif
            <article>
                <div class="step">{{ $step + 1 }}</div>
                <p>{!! nl2br($tip->tip_en) !!}
                @if ($tip->source_en <> '')
                    <span>{{ $tip->source_en }}</span>
                @endif
                </p>
                <div class="separador"></div>
            </article>
        @endforeach
        </div>
        <div class="separador"></div>
    </div>
</section>
@endsection
