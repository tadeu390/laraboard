@extends('adminlte::page')

@section('title', 'Novo Sub Menu')

@section('content_header')

@stop

@section('content')
    <div class="content row">
        <div class="box box-purple">
            @include('admin.includes.header_form')
            <div class="box-body">
                @include("admin.includes.alerts")
                {{ Form::open(['route' => 'menus.store', 'class' => 'form', 'method' => 'POST']) }}
                    @include('admin.menus._partials.form')
                    @include('admin.menus.submenus._partials.form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-purple">Adicionar &nbsp; <i class="fa fa-plus-circle"></i></button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop