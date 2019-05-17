<div class="form-group">
    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="name" value="{{$permission->name ?? old('name')}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label for="label">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="label" value="{{$permission->label ?? old('label')}}" name="label" class="form-control">
</div>