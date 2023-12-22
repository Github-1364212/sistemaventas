@extends('layouts.app')

@section('title', 'Visualizar Cliente')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="page-header">
    <h3 class="page-title">
        Visualizar Cliente
    </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Panel</a></li>
            <li class="breadcrumb-item"><a type="text" href="{{route('all.customer')}}">Mostrar Todo</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>Visualizar Cliente</span></li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample">
                    <div class="form-group" desactivated>
                        <label for="exampleInputName1">Nombres y Apellidos</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" value="{{$single->name}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail3" value="{{$single->email}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Telefono</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword4" value="{{$single->phone}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Dirección</label>
                        <input type="text" name="address" class="form-control" id="exampleInputPassword4" value="{{$single->address}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Nombre de tienda</label>
                        @if($single->shopname == null)
                        NONE
                        @else
                        <input type="text" name="shopname" class="form-control" id="exampleInputPassword4" value="{{$single->shopname}}" required readonly>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Ciudad</label>
                        <input type="text" name="city" class="form-control" id="exampleInputPassword4" value="{{$single->city}}" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Imagen</label><br>
                        <img style="height: 80px; width: 80px;" src="{{URL::to($single->photo)}}" />
                    </div>
                    <div class="form-group">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush
