@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8" style="height: 100px;">
            <a class="btn btn-success btn-sm float-right" href="{{ route('tags.create') }}"> Criar Tag</a>
        </div>
        
        <div class="col-md-8">
            
            <div class="card">
               
                <div class="card-header">Listando todas Tags</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="list-group">
                        <ul>
                        @foreach ($tags as $tag)
                       
                        <li class="list-group-item list-group-item-action ">
                            <a href="#" >
                                {{ $tag->name }}  
                               </a>
                            <span>
                            <form method="POST" action=" {{ route('tags.destroy',$tag->id) }} ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right">Deletar</button></span> 
                            </form>
                                
                        </li>
                        @endforeach
                    </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
