@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.categories')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route("categories.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.categories')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('categories.store') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="brand_id" value="{{ session('brand_id') }}">
    <div class="row">
        <div class="col-lg-12">
           <h3><i class="fa fa-globe"></i> English</h3>
       </div>
   </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group{{ $errors->has('category_en') ? ' has-error' : '' }}">
                <label>Category</label>
                <input type="text" class="form-control" name="category_en" value="{{ old('category_en') }}" maxlength="100" required autofocus>
                @if ($errors->has('category_en'))
                    <p class="help-block">{{ $errors->first('category_en') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Image</label>
                <div class="slim">
                    <input name="img" type="file" accept="image/jpeg, image/png" />
                </div>
                <label><span>Min size 293 x 310 px | JPG o PNG</span></label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
           <h3><i class="fa fa-globe"></i> Spanish</h3>
       </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="category_es" value="{{ old('category_es') }}" maxlength="100">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('categories.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '293:310',
    minSize: {
      width: 293,
      height: 310
    },
    size: {
      width: 293,
      height: 310
    }
  });
 })
</script>
@endsection
