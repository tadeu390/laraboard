<div class="form-group">
    <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="name" value="{{$module->name ?? old('name')}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label for="description">Descrição</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="description" value="{{$module->description ?? old('description')}}" name="description" class="form-control">
</div>
<div class="form-group">
    <label for="url">Url</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="url" value="{{$module->url ?? old('url')}}" name="url" class="form-control">
</div>
<div class="form-group">
    <label for="icon">Ícone</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="icon" value="{{$module->icon ?? old('icon')}}" name="icon" class="form-control">
</div>
<div class="form-group">
    <label for="nick_name">Apelido</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="nick_name" value="{{$module->nick_name ?? old('nick_name')}}" name="nick_name" class="form-control">
</div>