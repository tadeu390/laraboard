@extends('adminlte::page')

@section('title', 'Listagem de menus')

@section('content')
    <div class="content row">
        <div class="box box-purple">
            <div class="box-body">
                <form action="{{route('menus.search')}}" method="POST">
                    <div class="form form-inline">
                        @csrf
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['name'] ?? ''}}" placeholder="Nome" name="name" class="form-control">
                        </div>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="{{$data['description'] ?? ''}}" placeholder="Descrição" name="label" class="form-control">
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-purple" title="Pesquisar">Pesquisar &nbsp; <i class="fa fa-search"></i></button>
                    @if(isset($data))
                        <a href="{{route('menus.index')}}" class="btn btn-warning">Limpar filtros</a>
                    @endif
                </form>
            </div>
        </div>
        <div class="box box-purple">
            @include('admin.includes.header')
            <div class="row pr-2 pl-2">
                    <div class="col-lg-10" id="formMenu">
                        {{-- {{Form::open(['class' => 'form-inline'])}}
                            <div class="form-group">
                                    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
                                    <input type="text" id="name" value="{{$menu->name ?? old('name')}}" name="name" class="form-control">
                            </div>
                            <div class="form-group pl-2">
                                <label for="description">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
                                <input type="text" id="description" value="{{$menu->description ?? old('description')}}" name="description" class="form-control">
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-purple" id="addFormMenu">Salvar</button>
                            </div>
                            <div class="form-group pl-2">
                                <button class="btn btn-purple" id="addFormMenu">Cancelar</button>
                            </div>
                        {{Form::close()}} --}}
                    </div>
                    <div class="col-lg-2 text-right">
                        <button class="btn btn-purple" id="addFormMenu" onclick="Menu.addMenu();" >Novo menu</button>
                    </div>
                </div>
            <div class="box-body" id="indexMenu">
                @include('admin.includes.alerts')
                @each('admin.menus._partials.menu-item', $menus, 'item')

                <div class="row">
                    <div class="col-lg-12 text-right">
                        @if(isset($data))
                            {!! $menus->appends($data)->links() !!}
                        @else
                            {!! $menus->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Modal -->
<div class="modal fade" id="modal_module_menu" tabindex="-1" role="dialog" aria-labelledby="module_menuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="module_menuLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow: auto;">
                <form id="module_menu_body">

                </form>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-purple" id="bt_salvar_modal">Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_remove" tabindex="-1" role="dialog" aria-labelledby="modal_removeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_remove_label"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow: auto;">
                <span id="modal_remove_body"></span>
                <form id="modal_form_remove_body">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="Menu.confirmRemoveMenu();">Deletar</button>
            </div>
        </div>
    </div>
</div>

  <script type="text/javascript">
    window.onload = function ()
    {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    var Menu =
        {
            update : false,
            removeEventListener : function()
            {
                Menu.update = false;
                var el = document.getElementById('bt_salvar_modal'),
                    elClone = el.cloneNode(true);

                el.parentNode.replaceChild(elClone, el);
            },
            addMenu : function ()
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Novo menu');
                Menu.removeEventListener();
                Menu.loadFormMenu("http://laraboard.tadeu/admin/menus/create/");
                document.getElementById('bt_salvar_modal').addEventListener('click', function(){
                    if (Menu.menuValidate()) {
                        Menu.saveMenu("http://laraboard.tadeu/admin/menus");
                    }
                });
            },
            editMenu: function(menu_id)
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Editar menu');
                Menu.removeEventListener();
                Menu.update = true;
                Menu.loadFormMenu("http://laraboard.tadeu/admin/menus/" + menu_id + "/edit");
                document.getElementById('bt_salvar_modal').addEventListener('click', function(){
                    if (Menu.menuValidate()) {
                        Menu.saveMenu("http://laraboard.tadeu/admin/menus/" + menu_id);
                    }
                });
            },
            addSubmenu : function (menu_id)
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Novo submenu');
                Menu.removeEventListener();
                Menu.loadFormMenu("http://laraboard.tadeu/admin/menus/createSubmenu/" + menu_id);
                document.getElementById('bt_salvar_modal').addEventListener('click', function(){
                    if (Menu.menuValidate()) {
                        Menu.saveMenu("http://laraboard.tadeu/admin/menus");
                    }
                });
            },
            editSubmenu: function(menu_id)
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Editar Sub menu');
                Menu.removeEventListener();
                Menu.update = true;
                Menu.loadFormMenu("http://laraboard.tadeu/admin/menus/" + menu_id + "/editSubmenu");
                document.getElementById('bt_salvar_modal').addEventListener('click', function(){
                    if (Menu.menuValidate()) {
                        Menu.saveMenu("http://laraboard.tadeu/admin/menus/" + menu_id);
                    }
                });
            },
            menu_id : 0,
            removeMenu : function(menu_id, name)
            {
                $("#modal_remove_body").html("Deseja realmente apagar o menu <b>" + name + "</b>?");
                $('#modal_remove').modal("show");
                $("#modal_remove_label").html('Apagar menu');
                Menu.menu_id = menu_id;
            },
            confirmRemoveMenu : function()
            {
                var serializeDados = $('#modal_form_remove_body').serialize();
                $.ajax({
                    url: "http://laraboard.tadeu/admin/menus/" + Menu.menu_id,
                    type: 'POST',
                    data: serializeDados,
                    success: function(data, textStatus) {
                        location.reload();
                    },
                    error: function(xhr,er) {
                        alert('Houve um erro ao processar sua requisição.');
                    }
                });
            },
            removeSubmenu : function(menu_id, name)
            {
                $("#modal_remove_body").html("Deseja realmente apagar o submenu <b>" + name + "</b>?");
                $('#modal_remove').modal("show");
                $("#modal_remove_label").html('Apagar submenu');
                Menu.menu_id = menu_id;
            },
            moveSubmenu : function(menu_id)
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Mover submenu');
            },
            addModule : function(menu_id)//menu ou submenu
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Adicionar módulo');
                Menu.loadFormMenu("http://laraboard.tadeu/admin/menus/addModule/" + menu_id);
            },
            moveModule : function (module_id)
            {
                $('#modal_module_menu').modal("show");
                $("#module_menuLabel").html('Mover módulo');
            },
            /**
            * Carrega o formulário para adicionar novos menus.
            *
            * @param int id_menu -> Se for um submenu que será adicionado, então é necessário
            * informar o id do menu ou submenu que receberá este novo submenu.
            */
            loadFormMenu : function(url)
            {
                $.ajax({
                    url : url,
                    type : 'get'
                })
                .done(function(data){
                    $("#module_menu_body").html(data.content);
                    if (Menu.update) {
                        $("#module_menu_body").html(("<input type='hidden' name='_method' value='PUT'>" + $("#module_menu_body").html()));
                    }
                })
                .fail(function(jqXHR, textStatus, msg){
                    alert("Houve um erro ao precessar sua requisição.");
                });
            },
            menuValidate : function()
            {
                if ($("#name").val() == "") {
                    alert('Informe um nome para o menu.');
                    $("#name").focus();
                    return false;
                } else if ($("#description").val() == "") {
                    alert('Informe uma descrição para o menu.');
                    $("#description").focus();
                    return false;
                } else if ($("#icon").val() == "") {
                    alert('Informe um ícone para o menu.');
                    $("#icon").focus();
                    return false;
                }
                return true;
            },
            saveMenu : function(url)
            {
                var serializeDados = $('#module_menu_body').serialize();
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: serializeDados,
                    success: function(data, textStatus) {
                        location.reload();
                    },
                    error: function(xhr,er) {
                        alert('Houve um erro ao processar sua requisição.');
                    }
                });
            }
        }
  </script>
@stop
