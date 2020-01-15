@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8">
            <h1>Editar Post</h1>
        <form action="{{ route('posts.update',$posts->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="Imagem">Imagem</label>
                <input name="image" type="file" class="form-control" id="imagem"  placeholder="Imagem" value="{{$posts->image}}">
                    <img  src="{{ route('img',['path'=> $posts->image . '?w=900&h=100&fit=crop'])  }}" alt=""> 
                  
                   
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo</label>
                  <input name="title" type="titulo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titulo" value="{{$posts->title}}">
                </div>
                <div class="form-group">
                  <label for="categoria">Categoria</label>
                  <select name="categories_id" id="" class="form-control">
                @foreach ($categories as $categoria)
                  <option value="{{$categoria->id}}" @if($posts->categories_id == $categoria->id) selected @endif >{{ $categoria->title}}</option>
                @endforeach
              </select>
                </div>

                <div class="form-group">
                  <label for="descricao">Descricao</label>
                  <input name="description" type="text" class="form-control" id="descricao" placeholder="Descricao" value="{{$posts->description}}">
                </div>

                <div class="form-group">
                    <label for="data-criacao">Data Criaçao</label>
                    <input name="created_at" type="date" class="form-control" id="data-criacao" placeholder="Data Criacao" value="{{$posts->created_at}}">
                  </div>
                <div class="form-group">
                    <label for="conteudo">Conteudo</label>
                    <textarea name="content" type="text" class="form-control" id="counteudo" placeholder="Conteudo">{{$posts->content}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="conteudo">Tagas</label>
                    <select multiple name="tags[]" id="" class="form-control">
                      @foreach ($tags as $tag)
                    <option value="{{$tag->id}}"
                      @if($posts->hasTag($tag->id))
                        selected
                      @endif
                      
                    >{{$tag->name}}</option>
                      @endforeach
                    </select>
                  </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </form>
        </div>
    </div>
</div>
@endsection
