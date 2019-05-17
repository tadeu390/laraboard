@extends('adminlte::page')

@section('title', 'Editar categoria')

@section('content_header')
    <h1>
        Editar categoria
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('categorias.index')}}">Categorias</a>
        </li>
        <li>
            <a href="{{route('categorias.edit', $categoria->id)}}" class="active">Editar categoria</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                @include("admin.categorias.includes.alerts")
                <form action="{{route('categorias.update', $categoria->id)}}" class="form" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @include('admin.categorias._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop