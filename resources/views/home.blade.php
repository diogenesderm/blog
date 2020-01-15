@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('siderbar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listando todos Posts</div>

                <div class="container">
                    <table id="basic-laratable" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">   
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<script>
    
    $(document).ready(function(){
       
        $.noConflict();

        
    $("#basic-laratable").DataTable({
        serverSide: true,
        ajax: "{{ route('basic_laratable') }}",
        columns: [
            { name: 'name' },
            { name: 'email' }
        ],
    });
});
</script>
@endsection
