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
        <div class="col-lg-12">
           <h3><i class="fa fa-globe"></i> English</h3>
       </div>
   </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('tip_en') ? ' has-error' : '' }}">
                <label>Tip</label>
                <textarea class="form-control" name="tip_en" rows="8" required autofocus>{{ old('tip_en') }}</textarea>
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
            <div class="form-group">
                <input type="checkbox" class="" name="active" id="a_a" value="1" @if( old('active',1) == 1 ) checked @endif >&nbsp;&nbsp;<label for="a_a">Active</label>
            </div>
            <div class="form-group">
                <label>Publication date</label>
                <input type="date" class="form-control" name="publication_date" value="{{ old('publication_date') }}" maxlength="10">
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
                <label>Tip</label>
                <textarea class="form-control" name="tip_es" rows="8">{{ old('tip_es') }}</textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Source</label>
                <input type="text" class="form-control" name="source_es" value="{{ old('source_es') }}" maxlength="60">
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

