<div class="form-group">
    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="name" value="{{$menu->name ?? old('name')}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label for="description">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="description" value="{{$menu->description ?? old('description')}}" name="description" class="form-control">
</div>