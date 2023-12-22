@extends('layouts.app')

@section('title', 'Visualizar Salario')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Visualizar Salario
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a href="{{route('all.salary')}}">Mostrar Todo</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Visualizar Salario</span></li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Empleado</label>
                        <input type="text" name="emp_id" class="form-control" id="exampleInputPassword4" value="{{$salary->name}}"  readonly>

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Mes</label>
                        <input type="text" name="month" class="form-control" id="exampleInputPassword4" value="{{$salary->month}}"  readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Año</label>
                        <input type="text" name="year" class="form-control" id="exampleInputPassword4" value="{{$salary->year}}"  readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Pago</label>
                        <input type="text" name="advanced_salary" class="form-control" id="exampleInputPassword4" value="{{$salary->advanced_salary}}"  readonly>
                    </div>
                    <div class="form-group">
                    </div>
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
