@extends('layouts.app')

       <title>equipos</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.docente') }}">INICIO</a></li>
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
            <center><h6 class="m-0 font-weight-bold text-primary"> 1 EQUIPOS </h6> </center> <br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-12"  >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       1.1.- Visualize el total de equipos a su resguardo,caracteristicas especificas,generar reportes de acuerdo al formato especifico  o realizar operación de galeria. <br> <br> <br> 
                          <center> <a href="{{route('equipo.docente_1.1')}}"> SELECCIONE AQUI <br>(EQUIPOS EN RESGUARDO)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </section>
     

@endsection