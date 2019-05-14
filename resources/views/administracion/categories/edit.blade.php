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
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.categories')</a></li>
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
        <p class="text-right"><a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>
<form role="form" action="{{ route('categories.update', codifica($category->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
   
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group{{ $errors->has('category_en') ? ' has-error' : '' }}">
                <label>Category</label>
                <input type="text" class="form-control" name="category_en" value="{{ old('category_en', $category->category_en) }}" maxlength="100" required autofocus>
                @if ($errors->has('subcategory_en'))
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
                    @if($category->img<>'')
                    <img src="uploads/categories/{{ $category->img }}">
                @endif
                </div>
                <label><span>Min size 293 x 310 px | JPG o PNG</span></label>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('categories.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a> 
            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a> 
            <a href="{{ route('subcategories.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.subcategories')</a> 
            <a href="{{ route('categories_eliminar', codifica($category->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> @lang('administracion.eliminar')</a>
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
