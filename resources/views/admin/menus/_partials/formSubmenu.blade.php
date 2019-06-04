<div class="form-group">
    <label for="menu_id">Será adicionado ao menu:</label>
    {!! Form::select('menu_id', $menus, $menu_id, ['class' => 'form-control', 'id' => 'menu_id']); !!}<i></i>
</div>
@include('admin.menus._partials.form')