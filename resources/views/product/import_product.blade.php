@extends('layouts.app')

@section('title', 'Importar Producto')


@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Importar Producto
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a href="{{route('all.product')}}">Mostrar Todo</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Importar Producto</span></li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">

                <a href="{{route('export')}}" class="btn btn-primary mr-2"><i class="fas fa-download"></i> Descargar Xlsx</a><br><br>

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Hubo algunos problemas con su entrada.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <form class="forms-sample" action="{{route('import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="import_file" class="dropify" required/>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-danger mr-2"><i class="fas fa-upload"></i> Subir</button>
                </form>
                <br>
                <p>Descargue el archivo XLSX y borrelo, ahora escribe todo el producto enumerándolo e importarlo nuevamente, gracias.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('melody/js/formpickers.js')}}"></script>
<script src="{{asset('melody/js/form-addons.js')}}"></script>
<script src="{{asset('melody/js/x-editable.js')}}"></script>
<script src="{{asset('melody/js/dropzone.js')}}"></script>
<script src="{{asset('melody/js/jquery-file-upload.js')}}"></script>
<script src="{{asset('melody/js/formpickers.js')}}"></script>
<script src="{{asset('melody/js/form-repeater.js')}}"></script>


<script src="{{asset('melody/js/dropify.js')}}"></script>
<script src="{{asset('melody/js/file-upload.js')}}"></script>
<script src="{{asset('melody/js/select2.js')}}"></script>
<script src="{{asset('melody/js/typeahead.js')}}"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader(); // FileReader is a predefined method of javascript
            reader.onload = function(e) {
                $('#one')
                    .attr('src', e.target.result) // #one is the id of an img tag where you want to display image
                    .width(80)
                    .height(80)
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(Session::has('message'))
<script>
    var type = "{{Session::get('alert-type','info')}}"
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
</script>
@endif

<script>
    $(doument).on('click', '#delete', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
                title: "¿Esta seguro?",
                text: "Una vez eliminado, ¡no podrá recuperar este archivo!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("¡Su archivo está a salvo!");
                }
            });
    });
</script>
@endpush
