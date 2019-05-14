@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.categories')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.categories')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <form role="search" action="" name="f_search">
            <div class="input-group">
                <select name="q" class="form-control" onchange="document.f_search.submit();">
                @foreach($brands as $brand)
                    <option value="{{ codifica($brand->id) }}" @if($brand->id == session('q_brand_id')) selected @endif>{{ $brand->brand_en }}</option>
                @endforeach
                </select>
                <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
    <div class="col-lg-5">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@lang('administracion.categories')</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td><a href="{{ route('categories.edit', codifica($category->id) ) }}" title="@lang('administracion.editar')">{{ $category->category_en }}</a></td>
                        <td>
                            <a href="{{ route('categories.edit', codifica($category->id) ) }}" title="@lang('administracion.editar')"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('categories_eliminar', codifica($category->id) ) }}" title="@lang('administracion.eliminar')"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{$categories->render()}}
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    $(".bloquear").click(function(event){
        event.preventDefault();
        if(confirm("@lang('administracion.confirmar_eliminar')")){
            document.location=$(this).parent().attr("href");
        }
    })
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)
})
</script>
@endsection
