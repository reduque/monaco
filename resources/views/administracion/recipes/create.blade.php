@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.recipes')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route("recipes.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.recipes')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('recipes.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('recipes.store') }}" method="POST">
    {{ csrf_field() }}
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
            <div class="form-group">
                <label>Ingredients</label>
                <select class="form-control" name="recipes_categories_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(old('recipes_categories_id')==$category->id) selected @endif>{{ $category->category_en }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Ingredients</label>
                <textarea class="form-control" name="ingredients_en" rows="8">{{ old('ingredients_en') }}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Directions</label>
                <textarea class="form-control" name="directions_en" rows="8">{{ old('directions_en') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Image</label>
                <div class="slim">
                    <input name="picture" type="file" accept="image/jpeg, image/png" />
                </div>
                <label><span>Min size 512 x 516 px | JPG o PNG</span></label>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Serves</label>
                <input type="text" class="form-control" name="serves_en" value="{{ old('serves_en') }}" maxlength="10">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Time</label>
                <input type="text" class="form-control" name="time_en" value="{{ old('time_en') }}" maxlength="20">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('recipes.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '512:516',
      forceType: 'jpg',
    minSize: {
      width: 512,
      height: 516
    },
    size: {
      width: 512,
      height: 516
    }
  });
 })
</script>
@endsection
