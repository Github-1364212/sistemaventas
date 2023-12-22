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
                        <p class="mt-5 mb-2 text-right"><b>Nombre: {{$customer->name}}</b></p>
                        <p class="text-right">Tienda: {{$customer->shopname}}<br>Direccion: {{$customer->address}}<br>Telefono: {{$customer->phone}} <br>Fecha de la boleta: {{date('d/m/y')}}<br>Ciudad/Distrito: {{$customer->city}}</p>
                    </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>#</th>
                                    <th>Articulo</th>
                                    <th class="text-right">Cantidad</th>
                                    <th class="text-right">Precio Unico (S/.)</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($contents as $cont)
                                <tr class="text-right">
                                    <td class="text-left">{{$sl++}}</td>
                                    <td class="text-left">{{$cont->name}}</td>
                                    <td>{{$cont->qty}}</td>
                                    <td>{{$cont->price}}</td>
                                    <td>{{$cont->price * $cont->qty}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                    <h4 class="text-right mb-5">Total : S/.{{Cart::subtotal()}}</h4>
                    <hr>
                </div>
                <div class="container-fluid w-100">
                    <!-- <a href="#" onclick="window.print()" class="btn btn-primary float-right mt-4 ml-2"><i class="fa fa-print mr-1"></i>Imprimir</a> -->
                    <a href="#" class="btn btn-success float-right mt-4" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-share mr-1"></i>Enviar Boleta</a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Boleta de {{$customer->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="card-description">Total: {{Cart::total()}}</p>
                                    <form class="forms-sample" action="{{url('final-invoice')}}" method="POST">
                                        @csrf
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error )
                                                <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Metodo de pago</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="payment_status">
                                                            <option value="Contado">Contado</option>
                                                            <option value="Yape">Yape</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Pago (S/.)</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="pay">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">Debe (S/.)</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="due">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                        <input type="hidden" name="order_date" value="{{date('d/m/y')}}">
                                        <input type="hidden" name="order_status" value="pending">
                                        <input type="hidden" name="total_products" value="{{Cart::count()}}">
                                        <input type="hidden" name="total" value="{{Cart::subtotal()}}">


                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
