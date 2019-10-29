<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="all,follow">

    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
     @guest
         <title>@yield('title') Login</title>
     @else
         <title>@yield('title') Inicio</title>
     @endguest
     
     <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    
    <link href="{{ asset('css/EstiloIndex.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="{{ asset('css/grasp_mobile_progress_circle-1.0.0.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.buap.css') }}" rel="stylesheet" id="theme-stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('img/Logos/Navegador.png') }}" rel="icon" type="img/png">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


 </head>
<body onload="llamar_hora()">
  @guest
       @yield('content')
  @else

  @if(Auth::User()->TipoUsuario==1)
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
            <img 
            src="{{ asset('Almacenamiento/Coordinadores/'.Auth::user()->Icono) }}" alt="person" class="img-fluid rounded-circle"> <br><br> 
           <h5  style="color: #003b5c;">{{{Auth::user()->Nombre}}}</h5></span><span>COORDINADOR ADMINISTRATIVO</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="{{ route('home.administrador') }}" class="brand-small text-center"> <strong>R-</strong><strong class="text-primary">E</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Principal</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li><a href="{{ route('home.administrador') }}"> <i class="fas fa-home"></i>Inicio</a></li>
            <li><a href="{{ route('academia.index') }}"> <i class="fas fa-landmark"></i><b>Dirección y Academias</b></a></li>
            <li><a href="{{ route('instalacion.administrador') }}">   <i class="fas fa-building"></i><b>Instalaciones</b></a></li>
            <li><a href="{{ route('equipo.administrador') }}"><i class="fas fa-database"></i><b>Equipos</center></b></a></li>
            <li><a href="{{ route('formato_reporte.administrador') }}"><i class="fas fa-file-contract"></i><b>Formatos y Reportes</b></a></li>
            <li><a href="{{ route('usuario.administrador')}}"><i class="fas fa-users"></i><b>Coordinadores</b></a></li>
            <li><a href="{{ route('operacion.administrador')}}"><i class="fas fa-cogs"></i><b>Operaciones</b></a></li>
          </ul>
        </div>
      </div>
    </nav>
    @elseif(Auth::User()->TipoUsuario==2)
       <nav class="side-navbar">
         <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
              <img src="{{ asset('Almacenamiento/Coordinadores/'.Auth::user()->Icono) }}" alt="person" class="img-fluid rounded-circle"> <br><br> 
           <h5  style="color: #003b5c;">{{{Auth::user()->Nombre}}}</h5></span><span>COORDINADOR DE AREA</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="{{ route('home.area') }}" class="brand-small text-center"> <strong>R-</strong><strong class="text-primary">E</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
         <h5 class="sidenav-heading"></h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">    
               <li><a href="{{ route('home.area') }}"> <i class="fas fa-home"></i>Inicio</a></li>
               <li><a href="{{ route('instalacion.area') }}">   <i class="fas fa-building"></i><b>Instalaciones</b></a></li>
               <li><a href="{{ route('equipo.area') }}"><i class="fas fa-database"></i><b>Equipos</center></b></a></li>
               <li><a href="{{ route('formato_reporte.area') }}"><i class="fas fa-file-contract"></i><b>Formatos y Reportes</b></a></li>
               <li><a href="{{ route('recurso.index') }}"><i class="fas fa-chalkboard-teacher"></i><b>Recursos Digitales</b></a></li>
               <li><a href="{{ route('operacion.area') }}"><i class="fas fa-cogs"></i><b>Operaciones</b></a></li>
               
          </ul>
        </div>
    </nav>
    @elseif(Auth::User()->TipoUsuario==3)
      <nav class="side-navbar">
         <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
             <img src="{{ asset('Almacenamiento/Coordinadores/'.Auth::user()->Icono) }}" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5" style="color: #003b5c;">{{{Auth::user()->Nombre}}}</h2><span>COORDINADOR DOCENTE</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="{{ route('home.docente') }}" class="brand-small text-center"> <strong>R-</strong><strong class="text-primary">E</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
         <h5 class="sidenav-heading"></h5>
          <ul id="side-main-menu" class="side-menu list-unstyled">    
               <li><a href="{{ route('home.docente') }}"> <i class="fas fa-home"></i>Inicio</a></li>
               <li><a href="{{ route('equipo.docente') }}"><i class="fas fa-database"></i><b>Equipos</center></b></a></li>
               <li><a href="{{ route('recurso.docente') }}"><i class="fas fa-chalkboard-teacher"></i><b>Recursos Digitales</b></a></li>
               <li><a href="{{ route('formato_reporte.docente')}}"><i class="fas fa-file-contract"></i><b>Formatos y Reportes</b></a></li>
               <li><a href="{{ route('operacion.docente') }}"><i class="fas fa-cogs"></i><b>Operaciones</b></a></li>
          </ul>
        </div>
    </nav>
    @endif
    <div class="page">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header">
                 <a id="toggle-btn" href="#" class="boton_menu"><i class="fas fa-bars fa-2x" style= "height: 10px;"></i>
                 </a>
                <a href="" class="navbar-brand">
                  <div class=""><span>REDILAC</span><strong  style="color:#00b5e2;">-EMS</strong></div>
                </a>
              </div>

              <div class="navbar-header">
                  <div class="brand-text d-none d-md-inline-block">
                    <span style="color: white; color: #00b5e2;"><h3>BIENVENIDO</h3></span></div>
              </div>
        
              <div class="navbar-header">
                  <div class="brand-text d-none d-md-inline-block">
                    <span  id="actualizable" style="color: #003b5c  ; background: #00b5e2;">  <!--LLLAMAR HORA -->
                        
                    </span>
                  </div>
              </div>

              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center Ssalir">
                <!-- Log out-->
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <span class="d-none d-sm-inline-block">Salir</span><i class="fas fa-sign-in-alt"></i></a></li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </ul>
            </div>
          </div>
        </nav>
      </header>
            @if (Request::url() != route('/'))                    
                  @yield('content')
            @endif
        
         <br><br><br><br>
       <footer class="main-footer" style="background: #003b5c; border-color:#00b5e2; border-style:dashed; border-width:1px;">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-4 columna1">

                    <img src="{{ asset('img/Logos/logo_buap.png') }}" style="width: 50%;">
              </div>
              <div class="col-sm-4 columna2">
                     Benemérita Universidad Autónoma de Puebla.<br>4 sur 104 Centro Histórico<br>C.P. 72000 <br>Teléfono (222) 2 29 55 00
              </div>
              <div class="col-sm-4 columna3">
                    Preparatoria: "Lic. Benito Juárez García"<br>Boulevard 14 sur y Circuito Juan Pablo II <br>Col. Jardines de San Manuel 
                    <br>Teléfono (222) 2 29 55 00 ext.2453 
              </div>
             </div>
          </div>
        </footer>
      </div>
      
       @endguest

</body>

    <script src="{{ asset('js/custom.js') }}" defer> </script>
    <script src="{{ asset('vendor/popper.js/umd/popper.min.js') }}" defer> </script>
    <script src="{{ asset('js/grasp_mobile_progress_circle-1.0.0.min.js') }}" defer></script>
    <script src="{{ asset('vendor/jquery.cookie/jquery.cookie.js') }}" defer> </script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}" defer></script>
    <script src="{{ asset('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
    <script src="{{ asset('js/front.js') }}" defer></script>

    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}" defer></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/datatables-demo.js') }}" defer></script>
     <script src="{{asset('js/maphilight-master/jquery.maphilight.js') }}" defer> </script>
</html>