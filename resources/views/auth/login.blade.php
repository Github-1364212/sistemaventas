<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Melody Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('melody/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('melody/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('melody/vendors/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('melody/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('melody/images/favicon.png')}}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{asset('melody/images/logo.svg')}}" alt="logo">
                            </div>
                            <h4>¡Bienvenido de nuevo!</h4>
                            <h6 class="font-weight-light">¡Feliz de verte de nuevo!</h6>
                            <form method="POST" class="pt-3">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail">Correo electronico</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input name="email" type="email" required autofocus class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Correo electronico" value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Contraseña</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input name="password" type="password" required class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Contraseña">
                                    </div>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember">
                                            Mantener sesion activa
                                        </label>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Iniciar sesión</button>
                                </div>

                            </form>
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-fill-danger" role="alert">
                                <i class="fa fa-exclamation-triangle"></i><strong>¡Error!</strong> {{$error}}
                            </div>
                            @endforeach
                            @endif
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{session('status')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018 All rights reserved.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('melody/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('melody/vendors/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('melody/js/off-canvas.js')}}"></script>
    <script src="{{asset('melody/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('melody/js/misc.js')}}"></script>
    <script src="{{asset('melody/js/settings.js')}}"></script>
    <script src="{{asset('melody/js/todolist.js')}}"></script>
    <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:53 GMT -->

</html>
