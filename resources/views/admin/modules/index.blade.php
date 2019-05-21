@extends('adminlte::page')

@section('title', 'Listagem de módulos')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            <div class="box-body">
                <form action="{{route('modules.search')}}" method="POST">
                    <div class="form form-inline">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['name'] ?? ''}}" placeholder="Nome" name="name" class="form-control">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['description'] ?? ''}}" placeholder="Descrição" name="label" class="form-control">
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-purple" title="Pesquisar">Pesquisar &nbsp; <i class="fa fa-search"></i></button>
                    @if(isset($data))
                        <a href="{{route('modules.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                    @if (auth()->user()->hasPermission('CREATE', 'modules'))
                        <a href="{{route('modules.create')}}" class="btn btn-purple">Adicionar &nbsp; <i class="fa fa-plus-circle"></i></a>
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
                            <td>Descrição</td>
                            <td class="text-right">Ações</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><i class="{{$item->icon}}"></i>&nbsp;&nbsp;{{$item->name}}</td>
                                <td>{{$item->description}}</td>
                                <td class="text-right">
                                    @if (auth()->user()->hasPermission('UPDATE', 'modules'))
                                        <a href="{{route('modules.edit', $item->id)}}" title="Editar"><i class="fa fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;
                                    @endif
                                    <a href="{{route('modules.show', $item->id)}}" title="Visualizar"><i class="fa fa-info-circle"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        @if(isset($data))
                            {!! $modules->appends($data)->links() !!}
                        @else
                            {!! $modules->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop