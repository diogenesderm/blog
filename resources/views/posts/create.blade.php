@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8">
          <h1>Criar Post</h1>
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
                <div class="form-group">
                    <label for="Imagem">Imagem</label>
                    <input name="image" type="file" class="form-control" id="imagem"  placeholder="Imagem">
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo</label>
                <input name="title" type="titulo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titulo" >
                </div>
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <select name="categories_id" id="" class="form-control">
                @foreach ($categories as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->title}}</option>
                @endforeach
              </select>
                </div>

                <div class="form-group">
                  <label for="descricao">Descricao</label>
                  <input name="description" type="text" class="form-control" id="descricao" placeholder="Descricao">
                </div>

                <div class="form-group">
                    <label for="data-criacao">Data Criaçao</label>
                    <input name="created_at" type="date" class="form-control" id="data-criacao" placeholder="Data Criacao">
                  </div>
                <div class="form-group">
                    <label for="conteudo">Conteudo</label>
                    <textarea name="content" type="text" class="form-control" id="counteudo" placeholder="Conteudo"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="conteudo">Tagas</label>
                    <select multiple name="tags" id="select2" class="form-control js-example-basic-single">
                      @foreach ($tags as $tag)
                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach
                    </select>
                  </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div>
@endsection


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<script>
// In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
    $.noConflict();
   $('.js-example-basic-single').select2();
});
</script>
@endsection
