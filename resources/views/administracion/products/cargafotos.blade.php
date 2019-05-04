@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
    <style type="text/css">
    	.img_gale{width: 100%;}
    	.ulfotos{width: 100%; list-style:none; margin:0; padding: 0;}
    	.ulfotos li{width: 23%; padding: 1%; float: left; position: relative;}
    	.ulfotos li img{width: 100%;}
		.ulfotos li a{position: absolute;  top: 10px; right: 10px}
    </style>
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.galeria') - {{ $project->name }}</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route('admin.proyectos.edit', codifica(session('project_id')) ) }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.proyectos')</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.galeria')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
</div>

<form role="form" action="{{ route('cargafotos_nueva') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label>Image</label>
            <div class="slim">
              <input name="archivo" type="file" accept="image/jpeg, image/png, image/gif" />
            </div>
            <label><span>Min size 850 x 567 px | JPG o PNG</span></label>
          </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
            	<ul class="ulfotos">
	            @foreach($project->pictures as $picture)
	            	<li><img src="uploads/projects/{{ $project->id }}/{{ $picture->image }}"><a href="{{ route('eliminar_foto', codifica($picture->id)) }}"><i class="fa fa-fw fa-ban bloquear"></i></a></li>
	            @endforeach
	        </ul>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6">
        <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
        <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a> 
    </div>
</form>



<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            </table>
        </div>
    </div>
</div>


@endsection
@section('javascript')

<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.slim').slim({
      ratio: '850:567',
    minSize: {
      width: 850,
      height: 567
    },
    size: {
      width: 850,
      height: 567
    }
  });
 })
</script>
@endsection
