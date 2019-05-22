@extends('adminlte::page')

@section('title', 'Visualizar usuário')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                        <label for="name">Nome</label>
                    <input readonly="readonly" type="text" id="name" value="{{$usuario->name ?? old('name')}}" name="name" class="form-control">
                </div>
                <div class="form-group">
                        <label for="email">E-mail</label>
                    <input readonly="readonly" type="text" id="email" value="{{$usuario->email ?? old('email')}}" name="email" class="form-control">
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
                            @foreach ($usuario->roles as $item)
                            <tr>
                                <td><a href="{{route('roles.show', $item->id)}}">{{$item->name}}</a></td>
                                <td>{{$item->label}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <br />
                <fieldset class="p-2 border-fieldset">
                    <legend class="p-2">Grupos &nbsp;<i class="fa fa-fw fa-object-group"></i></legend>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>Descrição</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuario->groups as $item)
                            <tr>
                                <td><a href="{{route('groups.show', $item->id)}}">{{$item->name}}</a></td>
                                <td>{{$item->description}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </fieldset>
                <br />
                <div class="form-inline">
                    @if (auth()->user()->hasPermission('DELETE', 'users'))
                        <form action="{{route('usuarios.destroy', $usuario->id)}}" class="form" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">Deletar usuário</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop