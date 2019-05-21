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
                <form action="{{route('usuarios.updateGroups', $usuario->id)}}" class="form" method="POST">
                    <fieldset class="p-2 border-fieldset">
                        <legend class="p-2">Grupos &nbsp;<i class="fa fa-fw fa-object-group"></i></legend>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td>Descrição</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $item)
                                <tr>
                                    <td><a href="{{route('groups.show', $item->id)}}">{{$item->name}}</a></td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <?php $checked = ""; ?>
                                        @foreach ($usuario->groups as $item2)
                                            <?php if($item2->id == $item->id) $checked = "checked"; ?>
                                        @endforeach
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" <?php echo $checked; ?> class="custom-control-input" value="{{$item->id}}" id="role_id{{$item->id}}" name="groups[]">
                                            <label class="custom-control-label" for="role_id{{$item->id}}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                    <br />
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <button class="btn btn-purple">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@stop