@extends('layouts.app')

@section('title', 'Terminal de punto de venta')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Terminal de punto de venta (TPV)
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Terminal de punto de venta</span></li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="container text-center">
                        <div class="row pricing-table">
                            <div class="col-md-12 grid-margin stretch-card pricing-card">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Precio unico (S/.)</th>
                                                <th>Sub total</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        @php
                                        $article=Cart::content();
                                        @endphp
                                        <tbody>
                                            @foreach ($article as $prod)
                                            <tr>
                                                <td>{{$prod->name}}</td>
                                                <td>
                                                    <form action="{{url('/card-update/'.$prod->rowId)}}" method="POST" enctype="">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="number" class="form-control form-control-sm" name="qty" value="{{$prod->qty}}" style="width: 50px;">
                                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-check" style="color: #fcfcfc;"></i></button>

                                                        </div>
                                                    </form>
                                                </td>
                                                <td>{{$prod->price}}</td>
                                                <td>{{$prod->price * $prod->qty}}</td>
                                                <td><a href="{{URL::to('/card-remove/'.$prod->rowId)}}"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <div class="text-center pricing-card-head">
                            <h4 class="font-weight-normal mb-2">Cantidad: {{Cart::count()}}</h4>
                            <h4 class="font-weight-normal mb-2">Total: S/.{{Cart::subtotal()}}</h4>
                        </div>
                        <form action="{{url('/create-invoice')}}" method="POST">
                            @csrf
                            <div class="row grid-margin">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error )
                                    {{$error}}
                                    @endforeach

                                </div>
                                @endif

                            </div>
                            <div class="row grid-margin">
                                <label for="exampleFormControlSelect2">Seleccionar Cliente</label>
                                @php
                                $customer=DB::table('customers')->get();
                                @endphp
                                <select class="form-control" id="exampleFormControlSelect2" name="cus_id">
                                    <option disabled="" selected="">Selecionar Cliente</option>
                                    @foreach ($customer as $cus)
                                    <option value="{{$cus->id}}">{{$cus->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="template-demo">
                                <button type="submit" class="btn btn-primary btn-fw">Crear Boleta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row grid-margin">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Categoria</th>
                                            <th>Codigo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $row)
                                        <tr>
                                            <form action="{{url('/add-cart')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                <input type="hidden" name="name" value="{{$row->product_name}}">
                                                <input type="hidden" name="qty" value="1">
                                                <input type="hidden" name="price" value="{{$row->selling_price}}">

                                                <td>
                                                    <img src="{{URL::to($row->product_image)}}" width="60px" height="60px">
                                                </td>
                                                <td>{{$row->product_name}}</td>
                                                <td>{{$row->cat_name}}</td>
                                                <td>{{$row->product_code}}</td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button>
                                                </td>
                                            </form>
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
