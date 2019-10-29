@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>formato_reporte</title>

       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SECCIÓN FORMATOS/REPORTES</li>
          </ul>
        </div>
     </div>
      <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

        </div>
      <section class="statistics">
        <div class="container-fluid">
            <center><h6 class="m-0 font-weight-bold text-primary"> 4 FORMATOS Y REPORTES </h6> </center> <br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;" >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       4.1.- Si desea visualizar el total de reportes generados dentro del sistema REDILAC-EMS ,ademas de realizar alguna operación de reporte. <br> <br> <br> <br>
                          <center> <a href="{{{route('reporte.administrador_4.1')}}}"> SELECCIONE AQUI <br> (REPORTES)</a></center> <br>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;" >

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                        4.2.- Si desea visualizar los formatos administrativos o realizar alguna operación de formato.  
                        <br> <br> <br> <br> <br>
                          <center> <a href="{{{route('formato.administrador_4.2')}}}"> SELECCIONE AQUI <br> (FORMATOS)</a></center> <br>
                     </h6>
                 </div>
              </div>
            </div>

             <div class="col-lg-4"  >

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                      <h6 class="m-0 font-weight-bold text-primary"> 
                       
                           4.3.- Si desea  generar reportes de los equipos con estatus baja, por dirección de administración escolar o academias, en EXCEL y/o PDF.  <br> <br> <br> <br>
                           <center>  <a href="{{{route('reporte.administrador_4.3')}}}"> SELECCIONE AQUI <br> (REPORTES CON ESTATUS BAJA) </a> </center>
                     </h6>
                 </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">
            <div class="col-lg-6"  style="border-right-style: solid; border-color: #003B5C ;">
              <!-- Income-->
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                          4.4.- Si desea generar reportes, realizar  busquedas y consultas del total de equipos registrados por dirección de administración escolar o academias, en EXCEL y/o PDF. <br> <br> <br>
                                             <center> <a href="{{{route('reporte.administrador_4.4')}}}"> SELECCIONE AQUI 
                                                      <br> (CONSULTAS Y REPORTES FILTRO 1)</a> </center> <br>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-6" >

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                      
                        4.5.- Si desea generar reportes, realizar  busquedas y consultas del total de equipos registrados por instalaciones de la unidad academica en EXCEL y/o PDF. <br> <br> <br>
                                             <center> <a href="{{{route('reporte.administrador_4.5')}}}"> SELECCIONE AQUI 
                                                      <br> (CONSULTAS Y REPORTES FILTRO 2)</a> </center> <br>
                          
                     </h6>
                 </div>
              </div> 
            </div>
    
          </div>
          <br>  
        
        </div>
      </section>
     
     <script type="text/javascript">

     </script>

@endsection
