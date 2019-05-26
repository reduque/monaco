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
            <li><a href="{{ route('subcategories.index') }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.subcategories')</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('subcategories.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>
<form role="form" action="{{ route('subcategories.update', codifica($subcategory->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-12">
           <h3><i class="fa fa-globe"></i> English</h3>
       </div>
   </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('subcategory_en') ? ' has-error' : '' }}">
                <label>Sub category</label>
                <input type="text" class="form-control" name="subcategory_en" value="{{ old('subcategory_en', $subcategory->subcategory_en) }}" maxlength="100" required autofocus>
                @if ($errors->has('namsubcategory_ene'))
                    <p class="help-block">{{ $errors->first('subcategory_en') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description_en">{{ old('description_en', $subcategory->description_en) }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Image</label>
                <div class="slim">
                    <input name="img" type="file" accept="image/jpeg, image/png" />
                    @if($subcategory->img<>'')
                    <img src="uploads/subcategories/{{ $subcategory->img }}">
                @endif
                </div>
                <label><span>Min size 1024 x 512 px | JPG o PNG</span></label>
            </div>
        </div>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Main product</label>
                <select class="form-control" name="productoppal_id">
                    <option value="0">No apply</option>}
                    option
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @if($product->id == old('productoppal_id',$subcategory->productoppal_id)) selected @endif>{{ $product->name_en }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
           <h3><i class="fa fa-globe"></i> Spanish</h3>
       </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Sub category</label>
                <input type="text" class="form-control" name="subcategory_es" value="{{ old('subcategory_es', $subcategory->subcategory_es) }}" maxlength="100">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description_es">{{ old('description_es', $subcategory->description_es) }}</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('subcategories.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a> 
            <a href="{{ route('subcategories.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a> 
            <a href="{{ route('subcategories_eliminar', codifica($subcategory->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> @lang('administracion.eliminar')</a>
        </div>
    </div>
</form>


@endsection
@section('javascript')

<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)
    $(".btn-danger").click(function(event){
        event.preventDefault();
        if(confirm("@lang('administracion.confirmar_eliminar')")){
            document.location=$(this).attr("href");
        }
    })
})
</script>

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
