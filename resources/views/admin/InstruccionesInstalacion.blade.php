@extends('layouts.app') <!-- Herencia de plantilla blade -->
        <title>instrucciones</title>

        <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">INSTRUCCIONES</li>
          </ul>   
        </div>
     </div>
        <section>
         <div class="container-fluid">
          <!-- DataTales Example -->
          <br>
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 7px;">
              <h6 class="m-0 font-weight-bold text-primary">  

                 <center> INSTRUCCIONES.  </center><br> <br>

                1.-NO ACEPTARA ENCABEZADOS DIFERENTES A LOS DE LA PLANTILLA  FORMATO EXCEL.<br> <br>

                2.-TODOS LOS DATOS SE IMPORTARAN CON MAYUSCULA. <br> <br>

                3.-LOS DATOS DE LAS COLUMNAS TIPO_INSTALACION Y ACADEMIA-DIRECCION  SON EXTRICTAMENTE OBLIGATORIOS. <br> <br>

                4.-LOS DATOS DE LA COLUMNA NOMENCLATURA DEBE TENER UN MINIMO DE  3 y MAXIMO DE 50 CARACTERES. <br> <br>

                5.-LOS DATOS DE LA COLUMNA NOEDIFICIO Y UBICACION DEBE TENER UN MAXIMO DE 50 CARACTERES. <br> <br>


                6.-NO ACEPTARA DATOS DE LAS COLUMNAS  TIPO_INSTALACION Y ACADEMIA-DIRECCIÓN QUE NO ESTEN REGISTRADOS DENTRO DEL SISTEMA REDILAC-EMS.  <br> <br>

                      &nbsp;&nbsp;  6.1.-PARA LAS ACADEMIAS O DIRECCIÓN VEASE LA SECCIÓN DE "Dirrección y Academias" DEL MENU PRINCIPAL. <br> <br>

                       &nbsp;&nbsp; 6.2.-PARA EL TIPO DE INSTALACION VEASE EL PUNTO 2.4 DE ESTA MISMA SECCIÓN. <br> <br>
 

                7.-SI LA INFORMACIÓN NO CUMPLEN CON LO ANTERIORMENTE ESTABLECIDO TENDRA ERROR DE IMPORTACIÓN DE DATOS. <br>
              </h6>
            </div>
          <br>
                 <center> <a href="{{ URL::to('/instalacion/administrador') }}">
                  <button type="button" class="boton_EE btn btn-primary">
                    <i class="fas fa-reply">
                    </i> Regresar
                   </button>
                 </a></center>
           <br>
          </div>
        </div>
     </section>

@endsection