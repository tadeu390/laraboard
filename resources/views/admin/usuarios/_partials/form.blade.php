<div class="form-group">
        <label for="name">Nome</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="name" value="{{$usuario->name ?? old('name')}}" name="name" class="form-control">
</div>
<div class="form-group">
        <label for="email">E-mail</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="text" id="email" value="{{$usuario->email ?? old('email')}}" name="email" class="form-control">
</div>
<div class="form-group">
    <label for="password">Senha</label><i class="p-2 fa fa-asterisk text-danger fa-required-size"></i>
    <input type="password" id="password" name="password" class="form-control">
</div>