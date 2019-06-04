<div id="accordion{{$item->id}}">
    <div class="card">
        <div class="card-header" id="heading{{$item->id}}">
            <table class="w-100">
                <tr>
                    <td>
                        <button title="Clique para expandir" class="btn btn-purple collapsed" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapse{{$item->id}}">
                            <i class="fa fa-fw fa-{{$item->icon}}"></i>   {{$item->name}}
                            @if($item->menu != null)
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light" title="Mover submenu"><i class="fa fa-share"></i></span>
                                &nbsp;&nbsp;<span class="badge badge-light" title="Editar submenu" onclick="Menu.editSubmenu({{$item->id}});"><i class="fa fa-edit"></i></span>
                                &nbsp;&nbsp;<span class="badge badge-light" title="Remover submenu" onclick="Menu.removeSubmenu({{$item->id}},'{{$item->name}}');"><i class="fa fa-times"></i></span>
                            @else
                                &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light" title="Mover menu"><i class="fa fa-share"></i></span>
                                &nbsp;&nbsp;<span class="badge badge-light" title="Editar menu" onclick="Menu.editMenu({{$item->id}});"><i class="fa fa-edit"></i></span>
                                &nbsp;&nbsp;<span class="badge badge-light" title="Remover menu" onclick="Menu.removeMenu({{$item->id}},'{{$item->name}}');"><i class="fa fa-times"></i></span>
                            @endif
                        </button>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-purple" onclick="Menu.addSubmenu({{$item->id}});">Add Submenu</button>
                        <button class="btn btn-purple" onclick="Menu.addModule({{$item->id}});">Add módulo</button>
                    </td>
                </tr>
            </table>
        </div>

        <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="heading{{$item->id}}" data-parent="#accordion{{$item->id}}">
            <div class="card-body" title="Módulos e Submenus">
                @foreach ($item->modules as $module)
                <button title="" type="button" class="btn btn-purple ml-2 mt-2">
                    <i class="fa fa-fw fa-{{$module->icon}}"></i> {{$module->name}}
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light" title="Mover módulo"><i class="fa fa-share"></i></span>
                    &nbsp;&nbsp;<span class="badge badge-light" title="Remover módulo"><i class="fa fa-times"></i></span>
                </button>
                @endforeach
                @if(count($item->modules) > 0)
                    <br />
                    <br />
                @endif
                @if ($item->subMenus != null)
                    @each('admin.menus._partials.menu-item', $item->subMenus, 'item')
                @endif
            </div>
        </div>
    </div>
</div>
@if ($item->menu == null)
    <br />
@endif