@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.tips')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li><a href="{{ route("tips.index") }}"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.tips')</a></li>
            <li>@lang('administracion.crear')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('tips.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a></p>
    </div>
</div>

<form role="form" action="{{ route('tips.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('tip_en') ? ' has-error' : '' }}">
                <label>Tip</label>
                <textarea class="form-control" name="tip_en" rows="6" required autofocus>{{ old('tip_en') }}</textarea>
                @if ($errors->has('tip_en'))
                    <p class="help-block">{{ $errors->first('tip_en') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Source</label>
                <input type="text" class="form-control" name="source_en" value="{{ old('source_en') }}" maxlength="60">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> @lang('administracion.guardar')</button>  
            <a href="{{ route('tips.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> @lang('administracion.volver_lista')</a>
        </div>
    </div>
</form>

@endsection

