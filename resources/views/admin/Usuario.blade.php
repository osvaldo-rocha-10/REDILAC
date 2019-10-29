@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>usuario_coordinador</title>

       <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SECCIÓN COORDINADORES</li>
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
            <center><h6 class="m-0 font-weight-bold text-primary"> 5 COORDINADORES </h6> </center> <br><br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-6" style="border-right-style: solid; border-color: #003B5C ;" >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       5.1.- Si desea visualizar el total de coordinadores registrados , o realizar alguna operación de usuario. <br> <br> <br>
                          <center> <a href="{{route('usuario.administrador_5.1')}}"> SELECCIONE AQUI <br>(USUARIO COORDINADOR)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-6">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                        <h6 class="m-0 font-weight-bold text-primary">  
                        5.2.- Si desea visualizar  los resguardos de bienes por usuario de los coordinaodores de la unidad academica. <br><br><br>
                        <center><a href="{{route('usuario.administrador_5.2')}}"> SELECCIONE AQUI <br> (RESGUARDO DE BIENES POR USUARIO)</a> </center> 
                     </h6>
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