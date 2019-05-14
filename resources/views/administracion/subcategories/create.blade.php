@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.subcategories') - {{ $category->category_en }}</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.categories')</a></li>
            <li><a href="{{ route('categories.edit', codifica($category->id) ) }}"><i class="fa fa-fw fa-pencil"></i> {{ $category->category_en }}</a></li>
            <li><a href="{{ route("subcategories.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.subcategories')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('subcategories.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('subcategories.store') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ session('category_id') }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('subcategory_en') ? ' has-error' : '' }}">
                <label>Sub category</label>
                <input type="text" class="form-control" name="subcategory_en" value="{{ old('subcategory_en') }}" maxlength="100" required autofocus>
                @if ($errors->has('subcategory_en'))
                    <p class="help-block">{{ $errors->first('subcategory_en') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description_en">{{ old('description_en') }}</textarea>
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
                <label><span>Min size 1024 x 512 px | JPG o PNG</span></label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('subcategories.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '1024:512',
    minSize: {
      width: 1024,
      height: 512
    },
    size: {
      width: 1024,
      height: 512
    }
  });
 })
</script>
@endsection
