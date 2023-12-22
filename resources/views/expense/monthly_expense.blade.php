@extends('layouts.app')

@section('title', 'Gasto de Mes')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Gasto de Mes
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a type="text" href="{{route('today.expense')}}">Gasto de Hoy</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Gasto de Mes</span></li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                @php
                Date::setLocale('es');
                $month=Date::now()->format('F');
                @endphp
                <h4 class="card-title">Mes Actual: {{$month}}</h4>
                <div class="row grid-margin">
                    <div class="template-demo">
                        <a href="{{route('january.expense')}}" type="button" class="btn btn-primary btn-rounded btn-fw">Enero</a>
                        <a href="{{route('febreary.expense')}}" type="button" class="btn btn-light btn-rounded btn-fw">Febrero</a>
                        <a href="{{route('march.expense')}}" type="button" class="btn btn-success btn-rounded btn-fw">Marzo</a>
                        <a href="{{route('april.expense')}}" type="button" class="btn btn-danger btn-rounded btn-fw">Abril</a>
                        <a href="{{route('may.expense')}}" type="button" class="btn btn-warning btn-rounded btn-fw">Mayo</a>
                        <a href="{{route('june.expense')}}" type="button" class="btn btn-info btn-rounded btn-fw">Junio</a>
                        <a href="{{route('july.expense')}}" type="button" class="btn btn-light btn-rounded btn-fw">Julio</a>
                        <a href="{{route('august.expense')}}" type="button" class="btn btn-dark btn-rounded btn-fw">Agosto</a>
                        <a href="{{route('septembre.expense')}}" type="button" class="btn btn-warning btn-rounded btn-fw">Setiembre</a>
                        <a href="{{route('october.expense')}}" type="button" class="btn btn-primary btn-rounded btn-fw">Octubre</a>
                        <a href="{{route('november.expense')}}" type="button" class="btn btn-light btn-rounded btn-fw">Noviembre</a>
                        <a href="{{route('december.expense')}}" type="button" class="btn btn-success btn-rounded btn-fw">Diciembre</a>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Detalles</th>
                                        <th>Fecha</th>
                                        <th>Monto (S/.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $row)
                                    <tr>
                                        <td>{{$row->details}}</td>
                                        <td>{{$row->date}}</td>
                                        <td>{{$row->amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @php
                            $month = date("F");
                            $total = DB::table('expenses')->where('month',$month)->sum('amount');
                            @endphp
                            <h5 class="text-danger">Gasto total de este mes : {{$total}} Soles</h5>
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
