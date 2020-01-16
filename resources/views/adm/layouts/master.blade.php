<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'ADMIN | Compet')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  @yield('css')

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">

    html body
    {
      height: 100%;
      overflow: auto;
    }
    .flotante {
        display:scroll;
        position:fixed;
        bottom:50%;
        right:25px;
        width: 40px; 
        height: 40px; 
        border-radius: 25px; 
        text-align: center;
        vertical-align: middle;
    }
    
  </style>
</head>
<body class="hold-transition sidebar-mini ">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i> PANEL ADMIN</a>
        </li>
      </ul>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-user mr-2"></i> {{auth()->user()->name}}
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <span class="dropdown-item dropdown-header">
                <i class="fas fa-history"></i> {{ date('G:ia d-m-Y', strtotime(auth()->user()->last_login)) }}
              </span>
              <li>
                <a href="{{ route('perfil') }}" class="dropdown-item">
                  <i class="fas fa-database mr-2"></i> Mis datos
                </a>
              </li>
              <li>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt mr-2"></i> Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </li> 
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-building mr-2"></i> {{$empresa->nombre}}
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li>
                <a href="{{route('info.empresa','general')}}" class="dropdown-item">
                  <i class="fas fa-building mr-2"></i> Datos de la Empresa
                </a>
              </li>
              <li>
                <a href="{{route('info.empresa','emails')}}" class="dropdown-item">
                  <i class="fas fa-mail-bulk mr-2"></i> Emails de Formularios
                </a>
              </li>
              <li>
                <a href="{{route('info.empresa','redes')}}" class="dropdown-item">
                  <i class="fas fa-comments mr-2"></i> Redes Sociales
                </a>
              </li>
              <li>
                <a href="{{route('info.empresa','terminos')}}" class="dropdown-item">
                  <i class="fas fa-check-square mr-2"></i> Términos y condiciones
                </a>
              </li>
              <li>
                <a href="{{route('info.empresa','metadatos')}}" class="dropdown-item">
                  <i class="fas fa-chart-line mr-2"></i> Metadatos
                </a>
              </li>           
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}" target="_blank"><i class="nav-icon fas fa-external-link-alt" ></i> Zona Pública</a>
          </li>          
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </ul>
    </div>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-2">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-header">Zona Publica</li>
          <li class="nav-item has-treeview {{ request()->is('adm/home*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('adm/home*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('home.slider')}}" class="nav-link {{ request()->is('adm/home/slider*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link {{ request()->is('adm/home/extra*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contenido extra</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ request()->is('adm/empresa*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('adm/empresa*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-city"></i>
              <p>
                Empresa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('empresa.slider')}}" class="nav-link {{ request()->is('adm/empresa/slider*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('empresa.contenido')}}" class="nav-link {{ request()->is('adm/empresa/contenido*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contenido</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('timeline.index')}}" class="nav-link {{ request()->is('adm/empresa/timeline*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Linea de tiempo</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('servicios.index')}}" class="nav-link {{ request()->is('adm/servicios') ? 'active' : '' }}">
              <i class="nav-icon fas fa-certificate"></i>
              <p>
                Servicios
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('productos.index')}}" class="nav-link {{ request()->is('adm/productos') ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('proyectos.index')}}" class="nav-link {{ request()->is('adm/proyectos') ? 'active' : '' }}">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Proyectos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('clientes.index')}}" class="nav-link {{ request()->is('adm/clientes') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('sectores.index')}}" class="nav-link {{ request()->is('adm/sectores') ? 'active' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Sectores
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('texto.index')}}" class="nav-link {{ request()->is('adm/texto-extra') ? 'active' : '' }}">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
                Texto en Secciones
              </p>
            </a>
          </li>
          @if (auth()->user()->rol == 'admin')
            <li class="nav-header">Acceso Restringido</li>
            <li class="nav-item">
              <a href="{{route('usuarios.index')}}" class="nav-link {{ request()->is('adm/usuarios') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>  
          @endif        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        @include('flash::message')        
        @yield('contenido')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>By Osole</strong>
  </footer>
</div>

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<script type="text/javascript">
  var ruta = "{{route('adm')}}";

  var public = "{{ url('') }}";

  var leng = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  };

$(document).ready(function () {
  $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
  bsCustomFileInput.init();

});
</script>

@yield('js')

</body>
</html>
