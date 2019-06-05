{{Form::hidden('id', $menu->id ?? '')}}
@csrf
<div class="form-group">
    <label for="menu_id">Será adicionado ao menu:</label>
    {!! Form::select('menu_id', $menus, $menu_id, ['class' => 'form-control', 'id' => 'menu_id']); !!}<i></i>
</div>
<div class="form-group">
    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="name" value="{{$menu->name ?? old('name')}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label for="description">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="description" value="{{$menu->description ?? old('description')}}" name="description" class="form-control">
</div>
<div class="form-group">
    <label for="icon">Ícone</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="icon" value="{{$menu->icon ?? old('icon')}}" name="icon" class="form-control">
</div>