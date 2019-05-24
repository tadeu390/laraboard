@extends('adminlte::page')

@section('title', 'Visualizar permissão')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input readonly="readonly" type="text" id="name" value="{{$permission->name ?? old('name')}}" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="label">Descrição</label>
                    <input readonly="readonly" type="text" id="label" value="{{$permission->label ?? old('label')}}" name="label" class="form-control">
                </div>
                <fieldset class="p-2 border-fieldset">
                    <legend class="p-2">Funções</legend>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Descrição</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permission->roles as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->label}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <br />
                <div class="form-inline">
                    @canPermission('CREATE', 'permissions')
                        <form action="{{route('permissions.destroy', $permission->id)}}" class="form" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    @endcanPermission
                </div>
            </div>
        </div>
    </div>
@stop