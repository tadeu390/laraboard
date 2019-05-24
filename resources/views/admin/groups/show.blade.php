@extends('adminlte::page')

@section('title', 'Visualizar grupo')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input readonly="readonly" type="text" id="name" value="{{$group->name}}" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="label">Descrição</label>
                    <input readonly="readonly" type="text" id="label" value="{{$group->description}}" name="label" class="form-control">
                </div>
                <fieldset class="p-2 border-fieldset">
                    <legend class="p-2">Funções &nbsp;<i class="fa fa-fw fa-address-card"></i></legend>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Descrição</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group->roles as $item)
                            <tr>
                                <td><a href="{{route('roles.show', $item->id)}}">{{$item->name}}</a></td>
                                <td>{{$item->label}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <fieldset class="p-2 border-fieldset">
                        <legend class="p-2">Usuários &nbsp;<i class="fa fa-fw fa-users"></i></legend>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td>E-mail</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($group->users as $item)
                                <tr>
                                    <td><a href="{{route('roles.show', $item->id)}}">{{$item->name}}</a></td>
                                    <td>{{$item->email}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                <br />
                <div class="form-inline">
                    @canPermission('DELETE', 'groups')
                        <form action="{{route('groups.destroy', $group->id)}}" class="form" method="POST">
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