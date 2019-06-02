@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Olá, {{auth()->user()->name}}!</h1>
@stop

@section('content')
    <div class="row" id="cardsDashboard">
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-fw fa-users"></i>
                </div>
                <div class="card-body text-center">
                <p class="card-text">Usuários ({{$report->users}})</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-fw fa-address-card"></i>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Funções ({{$report->roles}})</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Permissões ({{$report->permissions}})</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4" id="cardsDashboard">
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-desktop"></i>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Módulos ({{$report->modules}})</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-object-group"></i>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Grupos ({{$report->groups}})</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" style="width: 18rem;">
                <div class="card-header text-center">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="card-body text-center">
                    <p class="card-text">Menus ({{$report->menus}})</p>
                </div>
            </div>
        </div>
    </div>
@stop