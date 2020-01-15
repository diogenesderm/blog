@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8" style="height: 100px;">
            <a class="btn btn-success btn-sm float-right" href="{{ route('posts.create') }}"> Criar post</a>
        </div>

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Listando todos Posts</div>
                <div class="card-body">
                    <div class="card-body p-0">
                        <iframe src="{{ route('elfinder.index') }}" width="100%" height="500px" class="border-0"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
