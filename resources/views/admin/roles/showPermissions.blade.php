@extends('adminlte::page')

@section('title', 'Editar permissões da função')

@section('content')
    <div class="content row" id='content'>
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include("admin.includes.alerts")
                <form action="{{route('roles.updatePermissions', $role->id)}}" class="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input readonly="readonly" type="text" id="name" value="{{$role->name ?? old('name')}}" name="name" class="form-control">
                    </div>
                    <fieldset class="p-2 border-fieldset">
                        <legend class="p-2">Permissões &nbsp;<i class="fa fa-fw fa-check-circle "></i></legend>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Módulo</td>
                                    @foreach ($permissions as $item)
                                        <td>{{$item->name}}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>
                                            <i class="{{$module->icon}}"></i>&nbsp;{{$module->name}}
                                            {{Form::hidden('module'.$module->id, $module->id)}}
                                        </td>
                                        @foreach ($permissions as $permission)
                                            <td>
                                                <?php
                                                    $level = 2;//não definido
                                                    foreach ($role->access_levels as $p) {
                                                        if ($p->pivot->module_id == $module->id && $p->pivot->permission_id == $permission->id) {
                                                            $level = $p->pivot->access_level_id;
                                                        }
                                                    }
                                                ?>
                                                {!! Form::select('module'.$module->id.'_'.$permission->name,
                                                    $access_levels, $level,
                                                    ['class' => 'form-control'],
                                                    $atributos)
                                                !!}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-purple">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop