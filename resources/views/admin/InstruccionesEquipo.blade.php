@extends('layouts.app') <!-- Herencia de plantilla blade -->
        <title>instrucciones</title>

        <!-- Librerias js  -->
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

                3.-LOS DATOS DE LAS COLUMNAS NOINVENTARIO , TIPO_EQUIPO E INSTALACION SON EXTRICTAMENTE OBLIGATORIOS. <br> <br>

                4.-LOS DATOS DE LA COLUMNA SERIE  Y MODELO DEBEN TENER UN MAXIMO DE 50 DIGITOS. <br> <br>

                5.-NO ACEPTARA DATOS DE  INSTALACIONES y TIPO_EQUIPO QUE NO ESTEN REGISTRADOS DENTRO DEL SISTEMA REDILAC-EMS.
                  <br> <br>

                      &nbsp;&nbsp;  5.1.-PARA LAS INSTALACIONES VEASE LA SECCION  "INSTALACIONES". <br> <br>

                       &nbsp;&nbsp; 5.2.-PARA EL TIPO_EQUIPO VEASE LA SUBSECCIÓN  7 "CATEGORIAS REGISTRADAS" DE ESTA MISMA SECCIÓN. <br> <br>
 

                6.-SI LA INFORMACIÓN NO CUMPLEN CON LO ANTERIORMENTE ESTABLECIDO TENDRA ERROR DE IMPORTACIÓN DE DATOS. <br>
              </h6>
            </div>
          <br>
                 <center> <a href="{{ route('equipo._3.2') }}">
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