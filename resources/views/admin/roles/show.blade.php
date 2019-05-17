@extends('adminlte::page')

@section('title', 'Visualizar Função')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input readonly="readonly" type="text" id="name" value="{{$role->name ?? old('name')}}" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="label">Descrição</label>
                    <input readonly="readonly" type="text" id="label" value="{{$role->label ?? old('label')}}" name="label" class="form-control">
                </div>
                <br />
                <fieldset class="p-2 border-fieldset">
                    <legend class="p-2">Usuários</legend>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>E-mail</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role->usuarios as $item)
                            <tr>
                                <td><a href="{{route('usuarios.show', $item->id)}}">{{$item->name}}</a></td>
                                <td>{{$item->email}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <br />
                <form action="{{route('roles.destroy', $role->id)}}" class="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Deletar</button>
                    <a href="{{route('roles.showPermissions', $role->id)}}" class="btn btn-purple">Editar permissões</a>
                </form>
            </div>
        </div>
    </div>
@stop