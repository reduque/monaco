@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.banners')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route("banners.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.banners')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('banners.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('banners.store') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ session('category_id') }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                <label>Title</label>
                <input type="text" class="form-control" name="title_en" value="{{ old('title_en') }}" maxlength="60" required autofocus>
                @if ($errors->has('title_en'))
                    <p class="help-block">{{ $errors->first('title_en') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link') }}" maxlength="200">
                @if ($errors->has('link'))
                    <p class="help-block">{{ $errors->first('link') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Image</label>
                <div class="slim">
                    <input name="img_en" type="file" accept="image/jpeg, image/png" />
                </div>
                <label><span>Min size 1024 x 516 px | JPG o PNG</span></label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="checkbox" class="" name="active" id="a_a" value="1" @if( old('active',1) == 1 ) checked @endif >&nbsp;&nbsp;<label for="a_a">Active</label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('banners.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '1024:516',
    minSize: {
      width: 1024,
      height: 516
    },
    size: {
      width: 1024,
      height: 516
    }
  });
 })
</script>
@endsection
