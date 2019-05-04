@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.tips')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route('tips.index') }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.tips')</a></li>
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
        <p class="text-right"><a href="{{ route('tips.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>
<form role="form" action="{{ route('tips.update', codifica($tip->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('tip_en') ? ' has-error' : '' }}">
                <label>Tip</label>
                <textarea class="form-control" name="tip_en" rows="8" required autofocus>{{ old('tip_en', $tip->tip_en) }}</textarea>
                @if ($errors->has('tip_en'))
                    <p class="help-block">{{ $errors->first('tip_en', $tip->title_en) }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Source</label>
                <input type="text" class="form-control" name="source_en" value="{{ old('source_en', $tip->source_en) }}" maxlength="60">
            </div>
            <div class="form-group">
                <input type="checkbox" class="" name="active" id="a_a" value="1" @if(old('active', $tip->active)==1) checked @endif >&nbsp;&nbsp;<label for="a_a">Active</label>
            </div>
            <div class="form-group">
                <label>Publication date</label>
                <input type="date" class="form-control" name="publication_date" value="{{ old('publication_date', $tip->publication_date) }}" maxlength="10">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('tips.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a> 
            <a href="{{ route('tips.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a> 
            <a href="{{ route('tips_eliminar', codifica($tip->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> @lang('administracion.eliminar')</a>
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
@endsection
