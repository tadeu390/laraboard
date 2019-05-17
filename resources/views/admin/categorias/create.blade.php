@extends('adminlte::page')

@section('title', 'Nova categoria')

@section('content_header')
    <h1>
        Cadastrar nova categoria
    </h1>
    
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('categorias.index')}}">Categorias</a>
        </li>
        <li>
            <a href="{{route('categorias.create')}}" class="active">Nova categoria</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                @include("admin.categorias.includes.alerts")
                <form action="{{route('categorias.store')}}" class="form" method="POST">
                    @include('admin.categorias._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop