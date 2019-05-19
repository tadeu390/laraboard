@extends('adminlte::page')

@section('title', 'Listagem de usuáriosa')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            <div class="box-body">
                <form action="{{route('usuarios.search')}}" method="POST">
                    <div class="form form-inline">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['name'] ?? ''}}" placeholder="Nome" name="name" class="form-control">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['email'] ?? ''}}" placeholder="E-mail" name="email" class="form-control">
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-purple" title="Pesquisar">Pesquisar &nbsp; <i class="fa fa-search"></i></button>
                    @if(isset($data))
                        <a href="{{route('usuarios.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                    @if(auth()->user()->hasPermission('CREATE', 'users'))
                        <a href="{{route('usuarios.create')}}" class="btn btn-purple">Adicionar &nbsp; <i class="fa fa-plus-circle"></i></a>
                    @endif
                </form>
            </div>
        </div>
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Nome</td>
                            <td>E-mail</td>
                            <td class="text-right">Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td class="text-right" id="acoes">
                                    @if(auth()->user()->hasPermission('UPDATE', 'users'))
                                        <a href="{{route('usuarios.edit', $item->id)}}" title="Editar"><i class="fa fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                    @endif
                                    <a href="{{route('usuarios.show', $item->id)}}" title="Visualizar"><i class="fa fa-info-circle"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="{{route('usuarios.showRoles', $item->id)}}" title="Funções"><i class="fa fa-address-card"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        @if(isset($data))
                            {!! $usuarios->appends($data)->links() !!}
                        @else
                            {!! $usuarios->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop