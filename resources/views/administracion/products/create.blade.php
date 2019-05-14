@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.products') - {{ $category->category_en }}</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route("products.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.products')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('products.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="category_id" value="{{ $category->id }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                <label>Name</label>
                <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" maxlength="100" required autofocus>
                @if ($errors->has('name_en'))
                    <p class="help-block">{{ $errors->first('name_en') }}</p>
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
<input type="hidden" name="brand_id" value="1">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Subcategory</label>
                <select class="form-control" name="subcategory_id">
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" @if($subcategory->id == old('subcategory_id')) selected @endif>{{ $subcategory->subcategory_en }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Line</label>
                <select class="form-control" name="line_id">
                @foreach($lines as $line)
                    <option value="{{ $line->id }}" @if($line->id == old('line_id')) selected @endif>{{ $line->line_en }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Country of Origin</label>
                <input type="text" class="form-control" name="country" value="{{ old('country') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Size</label>
                <input type="text" class="form-control" name="size" value="{{ old('size') }}" maxlength="60">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Pack</label>
                <input type="text" class="form-control" name="pack" value="{{ old('pack') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Ti/Hi</label>
                <input type="text" class="form-control" name="ti_hi" value="{{ old('ti_hi') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Bar Code</label>
                <input type="text" class="form-control" name="bar_code" value="{{ old('bar_code') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Shelf Life</label>
                <input type="text" class="form-control" name="shelf_life_en" value="{{ old('shelf_life_en') }}" maxlength="60">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Ingredients</label>
                <input type="text" class="form-control" name="ingredients_en" value="{{ old('ingredients_en') }}" maxlength="200">
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
                <label><span>Min size 370 x 400 px | JPG o PNG</span></label>
            </div>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Nutrition Facts</label>
                <input type="file" name="nutrition_facts">
            </div>
            <div class="form-group">
                <label>Spec Sheet</label>
                <input type="file" name="spec_sheets">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '370:400',
    minSize: {
      width: 370,
      height: 400
    },
    size: {
      width: 370,
      height: 400
    }
  });
 })
</script>
@endsection
