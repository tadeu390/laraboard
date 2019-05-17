@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if( $error = session( 'error' ) )
    <div class="alert alert-danger" data-error="{{ $error['class'] }}">
        {{ $error['message'] }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif