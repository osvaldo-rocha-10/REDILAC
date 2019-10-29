@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>equipo_información</title>

       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">INFORMACIÓN EQUIPO</li>
          </ul>
          <span style=" background: #003b5c; color: #00b5e2;"></span>
        </div>
     </div>
      <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

        </div>
        <section>
         <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">INFORMACIÓN EQUIPO</h3> </center> <br>

               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                    NO INVENTARIO  : {{{$equipo->NoInventario}}}<br>
                   </h5>
                </div>

               </div>

            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm " width="100%" cellspacing="0">
                     <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Academia</th>
                      <th>Categoria de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Tipo de Adquisición</th>
                      <th>Observación1</th>
                      <th>Observación2</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                      <tr>
                      <th>Academia</th>
                      <th>Categoria de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Tipo de Adquisición</th>
                      <th>Observación1</th>
                      <th>Observación2</th>
                    </tr>
                  </tfoot>
                  <tbody>
                         <tr>
                            <td>{{{$academia->Academia}}}</td>
                            <td>{{{$instalacion->Categoria}}}</td>
                            <td>{{{$equipo->Nomenclatura}}}</td>
                            <td>{{{$equipo->Serie}}}</td>
                            <td>{{{$equipo->Modelo}}}</td>
                            <td>{{{$equipo->Marca}}}</td>
                            <td>{{{$equipo->TipoAdquisicion}}}</td>
                            <td>{{{$equipo->Observacion1}}}</td>
                            <td>{{{$equipo->Observacion2}}}</td>
                         </tr>

                  </tbody>
                </table>
            </div>
            <br><br>
             <center>  <a href="{{url()->previous()}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a> </center>
          </div>
        </div>
  
     </section>

@endsection