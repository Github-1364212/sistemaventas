@extends('layouts.app')

@section('title', 'Visualizar asistencia')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Visualizar asistencia
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard">Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page">Visualizar asistencia</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Visualizar Asistencia {{$date->att_date}}</h4>
                <div class="row">
                    <div class="col-12">
                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th>Nombre</th>
                                            <th>Foto</th>
                                            <th>Asistencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $row)
                                        <tr>
                                            <td>{{$row->name}}</td>
                                            <td><img src="{{URL::to($row->photo)}}" style="height: 60px; width: 60px;"></td>
                                            <input type="hidden" name="user_id[]" value="{{$row->id}}">
                                            <td>
                                                <div class="form-check form-check-flat form-check-primary">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="attendence[{{$row->id}}]" value="Presente" disabled="" <?php if ($row->attendence == 'Presente') {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    } ?>>
                                                        Presente
                                                        <i class="input-helper"></i></label>
                                                </div>
                                                <div class="form-check form-check-flat form-check-primary"></div>

                                                <div class="form-check form-check-flat form-check-primary">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="attendence[{{$row->id}}]" value="Ausente" disabled="" <?php if ($row->attendence == 'Ausente') {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                                                        Ausente
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <input type="hidden" name="att_date" value="{{date('d/m/y')}}">
                                            <input type="hidden" name="att_year" value="{{date('Y')}}">

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
