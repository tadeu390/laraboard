Módulo: <b>{{$module->name}}</b>
{{Form::hidden('id', $module->id)}}
<br />
<br />
@csrf
<div class="form-group">
    <label for="menu_id">Menu</label>
    {!! Form::select('menu_id', $menus, $menu_id, ['class' => 'form-control']); !!}<i></i>
</div>