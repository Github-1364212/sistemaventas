@extends('layouts.app')

@section('title', 'Actualizar Producto')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Actualizar Producto
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a href="{{route('all.product')}}">Mostrar Todo</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Actualizar Producto</span></li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
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
                <form class="forms-sample" action="{{url('/update-product/'.$producto->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Nombres</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputName1" value="{{$producto->product_name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Codigo</label>
                        <input type="text" name="product_code" class="form-control" id="exampleInputEmail3" value="{{$producto->product_code}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Categoria</label>
                        @php
                        $cat=DB::table('categories')->get();
                        @endphp
                        <select name="cat_id" class="form-control" id="exampleFormControlSelect2">
                            @foreach($cat as $row)
                            <option value="{{$row->id}}" <?php if ($producto->cat_id == $row->id) {echo "selected";} ?>>{{$row->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Proveedor</label>
                        @php
                        $sup=DB::table('suppliers')->get();
                        @endphp
                        <select name="sup_id" class="form-control" id="exampleFormControlSelect2">
                            @foreach($sup as $row)
                            <option value="{{$row->id}}" <?php if ($producto->sup_id == $row->id) {echo "selected";} ?>>{{$row->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword4">Seccion</label>
                        <input type="text" name="product_garage" class="form-control" id="exampleInputPassword4" value="{{$producto->product_garage}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Ruta</label>
                        <input type="text" name="product_route" class="form-control" id="exampleInputPassword4" value="{{$producto->product_route}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Fecha de compra</label>
                        <input type="date" name="buy_date" class="form-control" id="exampleInputPassword4" value="{{$producto->buy_date}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Fecha de vencimiento</label>
                        <input type="date" name="expire_date" class="form-control" id="exampleInputPassword4" value="{{$producto->expire_date}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Precio de compra (S/.)</label>
                        <input type="text" name="buying_price" class="form-control" id="exampleInputPassword4" value="{{$producto->buying_price}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Precion de venta (S/.)</label>
                        <input type="text" name="selling_price" class="form-control" id="exampleInputPassword4" value="{{$producto->selling_price}}" required>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="file" name="product_image" class="file-upload-default" accept="img/*" onchange="readURL(this);">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" value="Cargar imagen">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Subir</button>
                            </span>
                        </div>
                        <img id="one" src="#" />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Foto actual</label>
                    </div>
                    <div class="form-group">
                        <img src="{{URL::to($producto->product_image)}}" style="height: 80px; width: 80px;">
                        <input type="hidden" name="old_photo" value="{{$producto->product_image}}">
                    </div>
                    <button type="submit" class="btn btn-danger btn-icon-text">
                        <i class="fa fa-upload btn-icon-prepend"></i>
                        Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
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
