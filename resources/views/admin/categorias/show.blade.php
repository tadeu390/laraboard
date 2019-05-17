@extends('adminlte::page')

@section('title', 'Visualizar categoria')

@section('content_header')
    <h1>
        Visualizar categoria
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('categorias.index')}}">Categorias</a>
        </li>
        <li>
            <a href="{{route('categorias.show', $categoria->id)}}" class="active">Visualizar categoria</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                <input type="hidden" name="_method" value="PUT">
                @include('admin.categorias._partials.form')
            </div>
            <form action="{{route('categorias.destroy', $categoria->id)}}" class="form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button href="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
    </div>
@stop