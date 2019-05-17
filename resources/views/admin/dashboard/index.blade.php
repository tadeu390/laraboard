@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Olá, {{auth()->user()->name}}!</h1>
@stop

@section('content')
    <div class="row" id="cardsDashboard">
        <div class="col-lg-4">
            <a href="{{url('admin/usuarios')}}">
                <div class="card" style="width: 18rem;">
                    <div class="card-header text-center">
                        <i class="fa fa-fw fa-users"></i>
                    </div>
                    <div class="card-body text-center">
                    <p class="card-text">Usuários ({{$report->users}})</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{url('admin/roles')}}">
                <div class="card" style="width: 18rem;">
                    <div class="card-header text-center">
                        <i class="fa fa-fw fa-address-card"></i>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Funções ({{$report->roles}})</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{url('admin/permissions')}}">
                <div class="card" style="width: 18rem;">
                    <div class="card-header text-center">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Permissões ({{$report->permissions}})</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@stop