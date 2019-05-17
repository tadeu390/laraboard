@extends('adminlte::page')

@section('title', 'Visualizar categoria')

@section('content_header')
    <h1>
        Visualizar produto
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('produtos.index')}}">Produtos</a>
        </li>
        <li>
            <a href="{{route('produtos.show', $produto->id)}}" class="active">Visualizar produto</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                <input type="hidden" name="_method" value="PUT">
                @include('admin.produtos._partials.form')
            </div>
            <form action="{{route('produtos.destroy', $produto->id)}}" class="form" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button href="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
    </div>
@stop