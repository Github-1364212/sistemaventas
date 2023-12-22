<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="{{asset('melody/images/faces/admin.png')}}" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">
                        Administrador
                    </p>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="fas fa-tachometer-alt menu-icon"></i>
                <span class="menu-title">Panel</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('pos')}}">
                <i class="fas fa-cart-plus menu-icon"></i>
                <span class="menu-title">TPV</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="fas fa-user-tie menu-icon"></i>
                <span class="menu-title">Empleados</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('add.employee')}}">Agregar Empleado</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('all.employee')}}">Mostrar Todos </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <i class="fas fa-user menu-icon"></i>
                <span class="menu-title">Clientes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('add.customer')}}">Agregar Cliente</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('all.customer')}}">Mostrar Todos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="fa fa-truck menu-icon"></i>
                <span class="menu-title">Proveedores</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('add.supplier')}}">Agregar Proveedor</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('all.supplier')}}">Mostrar Todos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
                <i class="fas fa-hand-holding-usd menu-icon"></i>
                <!-- <i class="far fa-handshake menu-icon"></i> -->
                <span class="menu-title">Salario (Empleado)</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="editors">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{route('add.salary')}}">Agregar Salario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('all.salary')}}">Mostrar todos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="fas fa-tag menu-icon"></i>
                <span class="menu-title">Categorias</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('add.category')}}">Agregar categoria</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('all.category')}}">Mostrar todos</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="fas fa-box menu-icon"></i>
                <span class="menu-title">Productos</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('add.product')}}">Agregar Producto</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('all.product')}}">Mostrar Todo</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('import.product')}}">Importar Producto</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="fas fa-money-bill-alt menu-icon"></i>
                <!-- <i class="fa fa-stop-circle menu-icon"></i> -->
                <span class="menu-title">Gastos</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('add.expense')}}">Agregar Gasto</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('today.expense')}}">Gasto de hoy</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('monthly.expense')}}">Gasto de mes</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
                <i class="fas fa-file-alt menu-icon"></i> <!-- <i class="fas fa-map-marker-alt menu-icon"></i> -->
                <span class="menu-title">Ordenes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="maps">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('pending.orders')}}">Ordenes</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="fas fa-file-invoice menu-icon"></i>
                <span class="menu-title">Asistencia</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('take.attendence')}}"> Tomar asistencia </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('all.attendence')}}"> Todas las asistencia </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#apps" aria-expanded="false" aria-controls="apps">
                <i class="fas fa-sliders-h menu-icon"></i>
                <span class="menu-title">Ajustes</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="apps">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('setting')}}"> Ajustes </a></li>
                </ul>`
            </div>
        </li>
    </ul>
</nav>
