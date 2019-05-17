@extends('adminlte::page')

@section('title', 'Novo produto')

@section('content_header')
    <h1>
        Cadastrar novo produto
    </h1>
    
    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('produtos.index')}}">Produtos</a>
        </li>
        <li>
            <a href="{{route('produtos.create')}}" class="active">Novo produto</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                @include("admin.produtos.includes.alerts")
                {{ Form::open(['route' => 'produtos.store', 'class' => 'form', 'method' => 'POST']) }}
                    @include('admin.produtos._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop