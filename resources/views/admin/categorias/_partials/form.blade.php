@csrf
<div class="form-group">
    <input type="text" id="title" value="{{$categoria->title ?? old('title')}}" name="title" placeholder="Título" class="form-control">
</div>
{{-- <div class="form-group">
    <input type="text" id="url" value="{{$categoria->url ?? old('url')}}" name="url" placeholder="URL" class="form-control">
</div> --}}
<div class="form-group">
    <textarea id="description" cols="30" rows="10" name="description" placeholder="Descrição" class="form-control">{{$categoria->description ?? old('description')}}</textarea>
</div>