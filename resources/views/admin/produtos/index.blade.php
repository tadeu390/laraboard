@extends('adminlte::page')

@section('title', 'Listagem de produtos')

@section('content_header')
    <h1>
        <a href="{{route('produtos.create')}}" class="btn btn-success">Adicionar</a>
        Produtos
    </h1>

    <ol class="breadcrumb">
        <li>
            <a href="{{route('admin')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{route('produtos.index')}}" class="active">Produtos</a>
        </li>
    </ol>
@stop

@section('content')
    <div class="content row">
        <div class="box box-success">
            <div class="box-body">
                <form action="{{route('produtos.search')}}" class="form form-inline" method="POST">
                    @csrf
                    {{-- <select name="categoria_id" id="categoria_id" class="form-control">
                        <option value="">Selecione</option>
                        @foreach ($categorias as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select> --}}

                    {!! Form::select('categoria_id', $categorias, $data['categoria_id'] ?? '', ['class' => 'form-control'], $atributos) !!}

                    <input type="text" value="{{$data['name'] ?? ''}}" placeholder="Nome" name="name" class="form-control">
                    <input type="text" value="{{$data['price'] ?? ''}}" placeholder="Preço" name="price" class="form-control">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                    @if(isset($data))
                        <a href="{{route('produtos.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                </form>
            </div>
        </div>
        <div class="box box-success">
            <div class="box-body">
                @include('admin.produtos.includes.alerts')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome</td>
                            <td>Categoria</td>
                            <td>Preço</td>
                            <td>Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $item)
                            @if(auth()->user()->hasPermission('READ', 'Produto', $item))
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->categoria->title}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>
                                        @can('UPDATE', 'Produto', $item)
                                            <a href="{{route('produtos.edit', $item->id)}}" class="badge bg-yellow">Editar</a>
                                        @endcan
                                        <a href="{{route('produtos.show', $item->id)}}" class="badge bg-yellow">Visualizar</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @if(isset($data))
                    {!! $produtos->appends($data)->links() !!}
                @else
                    {!! $produtos->links() !!}
                @endif
            </div>
        </div>
    </div>
@stop