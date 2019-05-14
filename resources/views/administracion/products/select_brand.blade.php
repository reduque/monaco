@extends('layouts.admin')

@section('css')
<style>
    .gradilla{
        display:-webkit-box; display:-ms-flexbox; display:flex;
        -ms-flex-wrap:wrap; flex-wrap:wrap;
    }
    .gradilla a{
        width: 25%;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        display: block;
        height: 200px;
        width: 200px;
        margin: 10px;
    }
</style>
@endsection
@section('content')
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.products')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.products')</li>
        </ol>
    </div>
</div>
<p>.</p>
<div class="row">
    <div class="col-lg-12 gradilla">
    @foreach ($brands as $brand)
    <a href="{{ route("products.index") }}?b={{ codifica($brand->id) }}" style="background-image:url(<?php
        if ($brand->id==1){
            echo "img/logo_negro.svg";
        }else if ($brand->type=='Private Label'){
            echo "uploads/brands/" . $brand->img;
        }else{
            echo "uploads/other_brads/" . $brand->img;
        }
        ?>)">
        </a>
    @endforeach
    </div>
</div>

@endsection
