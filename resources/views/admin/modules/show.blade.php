@extends('adminlte::page')

@section('title', 'Visualizar módulo')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="box-body">
                @include('admin.includes.alerts')
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input readonly="readonly" type="text" id="name" value="{{$module->name ?? old('name')}}" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <input readonly="readonly" type="text" id="label" value="{{$module->description ?? old('description')}}" name="label" class="form-control">
                </div>
                <div class="form-group">
                    <label for="url">Url</label>
                    <input readonly="readonly" type="text" id="url" value="{{$module->url ?? old('url')}}" name="label" class="form-control">
                </div>
                <div class="form-group">
                    <label for="icon">Ícone</label>
                    <input readonly="readonly" type="text" id="icon" value="{{$module->icon ?? old('icon')}}" name="icon" class="form-control">
                </div>
                <br />
                <form action="{{route('modules.destroy', $module->id)}}" class="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>
        </div>
    </div>
@stop