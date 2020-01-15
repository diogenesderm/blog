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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="list-group">
                        <table id="basic-laratable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Categoria</th>
                                    <th>Imagem</th>
                                    <th>Ação</th>
                                </tr>
                               
                            </thead>
                            
                        </table>
                        

                      </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>

<script>
    var editor;
    $(document).ready(function(){
        $.noConflict();
        var dataTableCustom = $.fn.dataTable.defaults;
       
    var table = $("#basic-laratable").DataTable({
        serverSide: true,
        ajax: "{{ route('posts_table') }}",
        columns: [
            { name: 'id' },
            { name: 'title' },
            { name: 'categoria'},
            {
                name: "image",
                render: function ( file_id ) {
                    console.log(file_id);
                    return file_id ?
                        '<img width="100px" src="storage/'+file_id+'"/>' :
                        
                        null;
                },
                defaultContent: "No image",
                title: "Image"
            },
            {name: 'actions', orderable: false, searchable: false},
        ],
     
    });


    $('body').on('click', '.delete-registry', function (event) {
    event.preventDefault();

    let el = $(this);
    let id = el.data('id');
    let ref = el.data('ref');
    let href = el.data('href');

    if (!ref || (!id && !href)) {
        console.error('The element needs "data-ref" and ("data-id" or "data-href") attributes!');
        return;
    }
    
   
    bootbox.confirm({
        title: '<i class="fas fa-exclamation-triangle"></i> Atenção!',
        message: 'Tem certeza de que deseja deletar este registro?!',
        buttons: {
            confirm: {
                className: 'btn-danger',
            },
        },
        callback: function (confirmed) {
            if (!confirmed) {
                return;
            }

            el.parent().append(`<div class="spinner-grow text-danger" data-ref="${ref}-${id}" role="status" style="width:1.4rem;height:1.4rem;"></div>`);
            el.hide();

            href = href || `${window.location.href}/${id}`;

            axios.delete(href).then(res => {
                window.location.reload();
            }).catch(error => {
                if (error.response.status === 404) {
                    let msg = 'Object or Route not found! \n';
                    msg += `Verify if exists a route: ${window.location.href}/{model|id}/toggle-active \n`;
                    msg += `Example: ${window.location.href}/${id}/toggle-active`;

                    console.error(msg);
                }

                $(`div[data-ref=${ref}-${id}]`).remove();

                el.show();
                // el.parent().append('<i class="fas fa-exclamation-triangle text-danger p-2"></i>');
            });
        }
    });
});
    
});
</script>
@endsection
