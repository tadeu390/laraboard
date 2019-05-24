@extends('adminlte::page')

@section('title', 'Editar Sub Menu')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header_form')
            <div class="box-body">
                @include("admin.includes.alerts")
                <form action="{{route('updateSubMenu.update', $menu->id)}}" class="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    @include('admin.menus._partials.form')
                    @include('admin.menus.submenus._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-purple">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop