@extends('adminlte::page')

@section('title', 'Listagem de categorias')

@section('content_header')
    <h1>
        <a href="{{route('categorias.create')}}" class="btn btn-success">Adicionar</a>
        Categorias
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('categorias.index')}}" class="active">Categorias</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                <form action="{{route('categorias.search')}}" class="form form-inline" method="POST">
                    @csrf
                    <input type="text" value="{{$data['title'] ?? ''}}" placeholder="Título" name="title" class="form-control">
                    <input type="text" value="{{$data['url'] ?? ''}}" placeholder="Url" name="url" class="form-control">
                    <input type="text" value="{{$data['description'] ?? ''}}" placeholder="Descrição" name="description" class="form-control">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                    @if(isset($data))
                        <a href="{{route('categorias.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                </form>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
                @include('admin.categorias.includes.alerts')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Título</td>
                            <td>Url</td>
                            <td>Descrição</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->url}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <a href="{{route('categorias.edit', $item->id)}}" class="badge bg-yellow">Editar</a>
                                    <a href="{{route('categorias.show', $item->id)}}" class="badge bg-yellow">Visualizar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(isset($data))
                    {!! $categorias->appends($data)->links() !!}
                @else
                    {!! $categorias->links() !!}
                @endif
            </div>
        </div>
    </div>
@stop