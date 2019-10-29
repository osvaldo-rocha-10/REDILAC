@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>equipos</title>

       <!-- Libreria js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SECCIÓN EQUIPOS</li>
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
            <center><h6 class="m-0 font-weight-bold text-primary"> 3 EQUIPOS </h6> </center> <br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;" >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       3.1.- Si desea visualizar el total de equipos registrados , su historial, caracteristicas especificas o realizar alguna operación de equipo, ademas de generar registros en modo EXCEL. <br> <br> <br> <br>
                          <center> <a href="{{{route('equipo.administrador_3.1')}}}"> SELECCIONE AQUI <br>(EQUIPOS REGISTRADOS)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;" >

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                        <h6 class="m-0 font-weight-bold text-primary">  
                        3.2.- Si desea subir un registro de equipos  en modo EXCEL , para la dirección de administración escolar o de alguna academia existente . <br> <br> <br> <br> <br>
                        <center><a href="{{{route('equipo.administrador_3.2')}}}"> SELECCIONE AQUI <br> (SUBIR LISTA DE CONCENTRADO)</a> </center> 
                     </h6>
                     </h6>
                 </div>
              </div>
            </div>

             <div class="col-lg-4">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                      <h6 class="m-0 font-weight-bold text-primary">  
                          3.3.- Si desea dar de baja una lista de equipos de la dirección de administración escolar o de alguna academia existente.<br> <br> <br> <br> <br>
                           <center>  <a href="{{{route('equipo.administrador_3.3')}}}"> SELECCIONE AQUI <br> (BAJA EQUIPOS) </a> </center>
                     </h6>
                 </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;">
              <!-- Income-->
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                         3.4.- Si desea visualizar y restaurar  equipos, ademas de generar registros en modo EXCEL. <br><br> <br> 
                                             <center> <a href="{{{route('equipo.administrador_3.4')}}}"> SELECCIONE AQUI <br>
                                             (VISUALIZAR Y RESTAURAR EQUIPOS)</a> </center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;">
              <!-- Income-->
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                        3.5.- Si desea visualizar el total de  categorias de equipo o realizar alguna operación de categoria. <br> <br> <br> <br>
                                            <center>  <a href="{{{route('tipo_equipo.administrador_3.6')}}}"> SELECCIONE AQUI <br>(CATEGORIAS REGISTRADAS)</a>  </center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       
                        3.6.- Si desea visualizar el total de marcas registradas o realizar alguna operación de marca. <br> <br> <br> <br>
                                          <center> <a href="   {{{route('marca.administrador_3.5')}}}"> SELECCIONE AQUI <br>

                                           (MARCAS REGISTRADAS)</a> </center>
                          
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