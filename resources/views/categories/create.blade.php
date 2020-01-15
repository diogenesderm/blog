@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8">
        <form action="{{ route('tags.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo</label>
                  <input name="name" type="titulo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titulo">
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div>
@endsection
