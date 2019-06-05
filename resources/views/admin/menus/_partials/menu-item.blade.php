<br />
<div id="accordion{{$item->id}}">
    <div class="card">
        <div class="card-header" id="heading{{$item->id}}">
            <table class="w-100">
                <tr>
                    <td>
                        <button title="Clique para expandir" class="btn btn-purple collapsed" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapse{{$item->id}}">
                            <i class="fa fa-fw fa-{{$item->icon}}"></i>   {{$item->name}}
                            &nbsp;&nbsp;<span class="badge badge-light" title="Editar menu" onclick="Menu.editMenu({{$item->id}});"><i class="fa fa-edit"></i></span>
                            &nbsp;&nbsp;<span class="badge badge-light" title="Remover menu" onclick="Menu.removeMenu({{$item->id}},'{{$item->name}}');"><i class="fa fa-times"></i></span>
                        </button>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-purple" onclick="Menu.addMenu({{$item->id}});">Add Submenu</button>
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
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light" onclick="Menu.moveModule({{$module->id}});" title="Mover módulo"><i class="fa fa-share"></i></span>
                    &nbsp;&nbsp;<span class="badge badge-light" title="Remover módulo" onclick="Menu.removeModule({{$module->id}})"><i class="fa fa-times"></i></span>
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