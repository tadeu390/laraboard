<table class="table table-sm bg-purple" style="margin-top: -5px;">
    <tr>
        <td style="border-right: 1px solid white; width: 10%;" class="text-center align-middle">
            <a href="javascript:window.history.go(-1)" title="Voltar" class="text-white">
                <i class="p-2 fa fa-chevron-circle-left"></i>
            </a>
            <a href="#" onclick="location.reload();" title="Recarregar" class="text-white">
                <i class="p-2 fa fa-undo"></i>
            </a>
        </td>
        <td class="align-middle text-left">
            <nav aria-label="breadcrumb" class="align-middle mt-3">
                <ol class="breadcrumb">
                    @foreach ($breadcrumb as $item)
                        <li class="breadcrumb-item">{{$item}}</li>
                    @endforeach
                </ol>
            </nav>
        </td>
    </tr>
</table>