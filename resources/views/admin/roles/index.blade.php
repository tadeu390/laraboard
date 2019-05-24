@extends('adminlte::page')

@section('title', 'Listagem de funções')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            <div class="box-body">
                <form action="{{route('roles.search')}}" method="POST">
                    <div class="form form-inline">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['name'] ?? ''}}" placeholder="Nome" name="name" class="form-control">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['label'] ?? ''}}" placeholder="Descrição" name="label" class="form-control">
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-purple" title="Pesquisar">Pesquisar &nbsp; <i class="fa fa-search"></i></button>
                    @if(isset($data))
                        <a href="{{route('roles.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                    @canPermission('CREATE', 'roles')
                        <a href="{{route('roles.create')}}" class="btn btn-purple">Adicionar &nbsp; <i class="fa fa-plus-circle"></i></a>
                    @endcanPermission
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
                            <td>Descrição</td>
                            <td class="text-right">Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->label}}</td>
                                <td class="text-right">
                                    @canPermission('UPDATE', 'roles')
                                        <a href="{{route('roles.edit', $item->id)}}" title="Editar"><i class="fa fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                    @endcanPermission
                                    <a href="{{route('roles.show', $item->id)}}" title="Visualizar"><i class="fa fa-info-circle"></i></a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="{{route('roles.showPermissions', $item->id)}}" title="Permissões"><i class="fa fa-lock"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        @if(isset($data))
                            {!! $roles->appends($data)->links() !!}
                        @else
                            {!! $roles->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop