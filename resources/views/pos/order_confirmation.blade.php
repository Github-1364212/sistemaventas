@extends('layouts.app')

@section('title', 'Boleta')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Boleta
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a type="text" href="{{route('pending.orders')}}">Ordenes Pendientes</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Visualizar Boleta</span></li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card px-2">
            <div class="card-body">
                <div class="container-fluid">
                    <h3 class="text-right my-5">Boleta&nbsp;&nbsp;</h3>
                    <hr>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                    <div class="col-lg-12 pl-0">
                        <p class="mt-5 mb-2 text-right"><b>Nombre: {{$order->name}}</b></p>
                        <p class="text-right">Tienda: {{$order->shopname}}<br>Direccion: {{$order->address}}<br>Telefono: {{$order->phone}} <br>Fecha de la boleta: {{$order->order_date}} <br> Ciudad/Distrito: {{$order->city}}</p>
                    </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th class="text-right">Cantidad</th>
                                    <th class="text-right">Precio Unico (S/.)</th>
                                    <th class="text-right">Subtotal (S/.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($order_details as $cont)
                                <tr class="text-right">
                                    <td class="text-left">{{$sl++}}</td>
                                    <td class="text-left">{{$cont->product_name}}</td>
                                    <td>{{$cont->product_code}}</td>
                                    <td>{{$cont->quantity}}</td>
                                    <td>{{$cont->unitcost}}</td>
                                    <td>{{$cont->unitcost * $cont->quantity}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                    <p class="text-right mb-3">Pagado por: {{$order->payment_status}}</p>
                    <p class="text-right mb-3">Pago (S/.): {{$order->pay}}</p>
                    <p class="text-right mb-3">Debe (S/.): {{$order->due}}</p>
                    <h4 class="text-right mb-5">Total (S/.): {{$order->total}}</h4>
                </div>
                <div class="container-fluid w-100">
                    <!-- <a href="#" onclick="window.print()" class="btn btn-primary float-right mt-4 ml-2"><i class="fa fa-print mr-1"></i>Imprimir</a> -->

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
