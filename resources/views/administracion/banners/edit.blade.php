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
            <li><a href="{{ route('banners.index') }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.banners')</a></li>
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
        <p class="text-right"><a href="{{ route('banners.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>
<form role="form" action="{{ route('banners.update', codifica($banner->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
   
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                <label>Title</label>
                <input type="text" class="form-control" name="title_en" value="{{ old('title_en', $banner->title_en) }}" maxlength="60" required autofocus>
                @if ($errors->has('namtitle_ene'))
                    <p class="help-block">{{ $errors->first('title_en') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link', $banner->link) }}" maxlength="200">
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
                <label><span>Min size 1024 x 760 px | JPG o PNG</span></label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <div class="form-group">
                    <input type="checkbox" class="" name="active" id="a_a" value="1" @if(old('active', $banner->active)==1) checked @endif >&nbsp;&nbsp;<label for="a_a">Active</label>
                </div>
                @if($banner->img_en<>'')
                    <p><img src="uploads/banners/{{ $banner->img_en }}" style="max-width:100%"></p>
                @endif
            </div>
        </div>
    
    </div>

    
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('banners.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a> 
            <a href="{{ route('banners.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a> 
            <a href="{{ route('banners_eliminar', codifica($banner->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> @lang('administracion.eliminar')</a>
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
      ratio: '1024:760',
    minSize: {
      width: 1024,
      height: 760
    },
    size: {
      width: 1024,
      height: 760
    }
  });
 })
</script>

@endsection
