@extends('layouts.app')

@section('title', 'Listado de Productos')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Listado de Productos
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de Productos</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12">
                        <a href="{{route('add.product')}}" type="button" class="btn btn-primary btn-fw"><i class="fa fa-plus-square"></i> Agregar Nuevo</a>
                        <a href="{{route('import.product')}}" type="button" class="btn btn-primary btn-fw"><i class="fas fa-file-import"></i> Importar producto</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Nombres</th>
                                        <th>Codigo</th>
                                        <th>Precio de venta (S/.)</th>
                                        <th>Imagen</th>
                                        <th>Seccion</th>
                                        <th>Ruta</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $row)
                                    <tr>
                                        <td>{{$row->product_name}}</td>
                                        <td>{{$row->product_code}}</td>
                                        <td>{{$row->selling_price}}</td>
                                        <td><img src="{{$row->product_image}}" style="height: 60px; width: 60px;"></td>
                                        <td>{{$row->product_garage}}</td>
                                        <td>{{$row->product_route}}</td>
                                        <td class="text-right">
                                            <a href="{{URL::to('edit-product/'.$row->id)}}" class="btn btn-light">
                                                <i class="fa fa-edit text-dark"></i> Editar
                                            </a>
                                            <a href="{{URL::to('view-product/'.$row->id)}}" class="btn btn-light">
                                                <i class="fa fa-eye text-primary"></i> Ver
                                            </a>
                                            <a href="{{URL::to('delete-product/'.$row->id)}}" id="delete" class="btn btn-light">
                                                <i class="fa fa-times text-danger"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('melody/js/data-table.js')}}"></script>
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
        $(document).on('click', '#delete', function(e) {
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
