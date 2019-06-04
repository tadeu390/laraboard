<div class="form-group">
    <label for="menu_id">Será adicionado ao menu:</label>
    {!! Form::select('menu_id', $menus, $menu_id, ['class' => 'form-control']); !!}<i></i>
</div>
<p>Módulos disponíveis</p>
@foreach($modules as $item)
    @if($item->menu == null)
        <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" value="{{$item->id}}" id="role_id{{$item->id}}" name="roles[]">
            <label class="custom-control-label" for="role_id{{$item->id}}">{{$item->name}}</label>
        </div>
    @endif
@endforeach