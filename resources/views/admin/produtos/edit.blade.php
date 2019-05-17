@extends('adminlte::page')

@section('title', 'Editar produto')

@section('content_header')
    <h1>
        Editar produto
    </h1>
    
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('produtos.index')}}">Produtos</a>
        </li>
        <li>
            <a href="{{route('produtos.edit', $produto->id)}}" class="active">Editar produto</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                @include("admin.produtos.includes.alerts")
                <form action="{{route('produtos.update', $produto->id)}}" class="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    @include('admin.produtos._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop