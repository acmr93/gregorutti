<header >
    <nav id="navbarfirst" class="navbar navbar-light navbar-expand-md py-0">
        <div class="container">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 ">
                <ul class="navbar-nav mr-auto">
                </ul>
            </div>
            <div class="mx-auto order-0 d-flex align-items-center">
                <a class="navbar-brand order-first order-md-0 mx-4 py-1" href="{{route('home')}}" >
                    <img class=" mx-auto d-block" src="{{asset('images/logos/header.png')}}" >
                </a>
                <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 d-none d-md-block">
                <ul class="nav navbar-nav w-100 order-3  justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('presupuesto')}}"> <i class="fa fa-calculator fa-lg pr-2"></i>SOLICITUD DE PRESUPUESTO</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <nav  id="navbar" class="navbar navbar-light navbar-expand-md ">
        <div class="container">
            <div class="collapse navbar-collapse w-100">
                <ul class="nav navbar-nav w-100 order-2 justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'empresa' ? 'active' : '' }}" href="{{route('empresa')}}">Empresa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'servicios' ? 'active' : '' }}" href="{{route('servicios')}}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'productos' ? 'active' : '' }}" href="{{route('productos')}}">Productos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'proyectos' ? 'active' : '' }}" href="{{route('proyectos')}}">Proyectos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'clientes' ? 'active' : '' }}" href="{{route('clientes')}}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'sectores' ? 'active' : '' }}" href="{{route('sectores')}}">Sectores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'contacto' ? 'active' : '' }}" href="{{route('contacto')}}">Contacto</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="#"> <i class="fa fa-calculator fa-lg pr-2"></i>SOLICITUD DE PRESUPUESTO</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>



