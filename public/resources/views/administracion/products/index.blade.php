@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">@lang('administracion.products')</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('administracion_home') }}"><i class="fa fa-dashboard"></i> @lang('administracion.inicio')</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> @lang('administracion.products')</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
            <form role="search" action="" name="f_search">
                <div class="input-group">
                    <select name="q" class="form-control" onchange="document.f_search.submit();">
                    @foreach($categories as $category)
                        <option value="{{ codifica($category->id) }}" @if($category->id == session('q_category_id')) selected @endif>{{ $category->category_en }}</option>
                    @endforeach
                    </select>
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Buscar</button>
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
        <p class="text-right"><a href="{{ route('products.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> @lang('administracion.nuevo')</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@lang('administracion.products')</th>
                        <th>Category</th>
                        <th>Subategory</th>
                        <th>Line</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td><a href="{{ route('products.edit', codifica($product->id) ) }}" title="@lang('administracion.editar')">{{ $product->name_en }}</a></td>
                        <td><a href="{{ route('products.edit', codifica($product->id) ) }}" title="@lang('administracion.editar')">{{ $product->category->category_en }}</a></td>
                        <td><a href="{{ route('products.edit', codifica($product->id) ) }}" title="@lang('administracion.editar')">{{ $product->subcategory->subcategory_en }}</a></td>
                        <td><a href="{{ route('products.edit', codifica($product->id) ) }}" title="@lang('administracion.editar')">{{ $product->line->line_en }}</a></td>
                        <td>
                            <a href="{{ route('products.edit', codifica($product->id) ) }}" title="@lang('administracion.editar')"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('products_eliminar', codifica($product->id) ) }}" title="@lang('administracion.eliminar')"><i class="fa fa-fw fa-ban bloquear"></i></a>
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
        {{$products->render()}}
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
