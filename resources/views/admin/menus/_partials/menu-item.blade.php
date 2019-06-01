<div id="accordion{{$item->id}}">
    <div class="card">
        <div class="card-header" id="heading{{$item->id}}">
            <table class="w-100">
                <tr>
                    <td>
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                            {{$item->name}}
                        </button>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-purple">Add Submenu</button>
                        <button class="btn btn-purple">Add módulo</button>
                    </td>
                </tr>
            </table>
        </div>

        <div id="collapse{{$item->id}}" class="collapse show" aria-labelledby="heading{{$item->id}}" data-parent="#accordion{{$item->id}}">
            <div class="card-body">
                @foreach ($item->modules as $module)
                    <a href="">{{$module->name}}</a><br />
                @endforeach
                @if ($item->subMenus != null)
                    @each('admin.menus._partials.menu-item', $item->subMenus, 'item')
                @endif
            </div>
        </div>
    </div>
</div>