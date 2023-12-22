@extends('layouts.app')

@section('title', 'Panel')

@push('css')
@endpush

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{session('status')}}
</div>
@endif
<div class="page-header">
    <h3 class="page-title">
        Panel
    </h3>
</div>
@php
$sum_employee = DB::table('employees')->count('id');
$sum_customer = DB::table('customers')->count('id');
$sum_supplier = DB::table('suppliers')->count('id');
$sum_product = DB::table('products')->count('id');
$sum_category = DB::table('categories')->count('id');
$sum_order = DB::table('orders')->count('id');
$sum_salary = DB::table('salaries')->sum('advanced_salary');
$date = date("d/m/y");
$month = date("F");
$month_expense = DB::table('expenses')->where('month', $month)->sum('amount');
$today_order = DB::table('orders')->where('order_date', $date)->sum('total');
$sum_expense = DB::table('expenses')->count('id');
$sum_order = DB::table('orders')->where('order_date', $date)->count('id');

@endphp
<div class="row grid-margin">
    <div class="col-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-user-tie mr-2"></i>
                            Empleados
                        </p>
                        <h2>{{$sum_employee}}</h2>
                        <a href="{{route('all.employee')}}" type="button" class="btn btn-inverse-success btn-fw">Ver Más</a>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-user mr-2"></i>
                            Clientes
                        </p>
                        <h2>{{$sum_customer}}</h2>
                        <a href="{{route('all.customer')}}" type="button" class="btn btn-inverse-info btn-fw">Ver Más</a>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fa fa-truck mr-2"></i>
                            Proveedores
                        </p>
                        <h2>{{$sum_supplier}}</h2>
                        <a href="{{route('all.supplier')}}" type="button" class="btn btn-inverse-warning btn-fw">Ver Más</a>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-box mr-2"></i>
                            Productos
                        </p>
                        <h2>{{$sum_product}}</h2>
                        <a href="{{route('all.product')}}" type="button" class="btn btn-inverse-danger btn-fw">Ver Más</a>
                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-tag mr-2"></i>
                            Categorias
                        </p>
                        <h2>{{$sum_category}}</h2>
                        <a href="{{route('all.category')}}" type="button" class="btn btn-inverse-info btn-fw">Ver Más</a>

                    </div>
                    <div class="statistics-item">
                        <p>
                            <i class="icon-sm fas fa-file-alt mr-2"></i>
                            Ordenes
                        </p>
                        <h2>{{$sum_order}}</h2>
                        <a href="{{route('pending.orders')}}" type="button" class="btn btn-inverse-success btn-fw">Ver Más</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Gasto Mensual</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">S/.{{$month_expense}}</h2>
                            @php
                            Date::setLocale('es');
                            $mes=Date::now()->format('F');
                            $hora=Date::now()->format('H:i');
                            @endphp
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-calendar text-muted"></i>
                                <small class=" ml-1 mb-0">Mes Actual: {{$mes}}</small>
                            </div>
                        </div>
                        <small class="text-gray">Total contado con {{$sum_expense}} gastos.</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-dollar-sign text-success icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">Orden diario</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-inline-block pt-3">
                        <div class="d-md-flex">
                            <h2 class="mb-0">S/.{{$today_order}}</h2>
                            <div class="d-flex align-items-center ml-md-2 mt-2 mt-md-0">
                                <i class="far fa-clock text-muted"></i>
                                <small class="ml-1 mb-0">Hora Actualizada: {{$hora}}</small>
                            </div>
                        </div>
                        <small class="text-gray">Total contado con {{$sum_order}} ordenes diarios.</small>
                    </div>
                    <div class="d-inline-block">
                        <i class="fas fa-shopping-cart text-danger icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="{{asset('melody/js/dashboard.js')}}"></script>
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
