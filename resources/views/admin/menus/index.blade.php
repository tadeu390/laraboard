@extends('adminlte::page')

@section('title', 'Listagem de menus')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            <div class="box-body">
                <form action="{{route('menus.search')}}" method="POST">
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
                        <a href="{{route('menus.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                </form>
            </div>
        </div>
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="row pr-2 pl-2">
                    <div class="col-lg-10" id="formMenu">
                        {{Form::open(['class' => 'form-inline'])}}
                            <div class="form-group">
                                    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
                                    <input type="text" id="name" value="{{$menu->name ?? old('name')}}" name="name" class="form-control">
                            </div>
                            <div class="form-group pl-2">
                                <label for="description">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
                                <input type="text" id="description" value="{{$menu->description ?? old('description')}}" name="description" class="form-control">
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-purple" id="addFormMenu">Salvar</button>
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-purple" id="addFormMenu">Cancelar</button>
                            </div>
                        {{Form::close()}}
                    </div>
                    <div class="col-lg-2 text-right">
                        <button class="btn btn-purple" id="addFormMenu">Novo menu</button>
                    </div>
                </div>
            <div class="box-body">
                @include('admin.includes.alerts')
                @each('admin.menus._partials.menu-item', $menus, 'item')

                <div class="row">
                    <div class="col-lg-12 text-right">
                        @if(isset($data))
                            {!! $menus->appends($data)->links() !!}
                        @else
                            {!! $menus->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop