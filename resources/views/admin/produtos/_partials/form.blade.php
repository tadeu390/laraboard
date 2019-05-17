<div class="form-group">
    <input type="text" id="name" value="{{$produto->name ?? old('name')}}" name="name" placeholder="Nome" class="form-control">
</div>
<div class="form-group">
    <input type="text" id="url" value="{{$produto->url ?? old('url')}}" name="url" placeholder="URL" class="form-control">
</div>
<div class="form-group">
    <input type="text" id="price" value="{{$produto->price ?? old('price')}}" name="price" placeholder="Preço" class="form-control">
</div>
<div class="form-group">
    <select name="categoria_id" id="categoria_id" class="form-control">
        <option value="">Selecione</option>
        @foreach ($categorias as $key => $item)
            <option @if(isset($produto) && $key == $produto->categoria_id) selected @endif value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <textarea id="description" cols="30" rows="10" name="description" placeholder="Descrição" class="form-control">{{$produto->description ?? old('description')}}</textarea>
</div>