@extends('layouts.app')

       <title>equipos_resguardo</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
             
            <li class="breadcrumb-item"><a href="{{ route('home.docente') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SUBSECCIÓN EQUIPOS EN RESGUARDO</li>
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
        <section>
      
         <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
             <center> 1.1 SUBSECCIÓN EQUIPOS EN RESGUARDO </center>
               <br>
               <br>

                1.1.1.-Agrege o edite una observación en la columna "Observación". <br><br>
                1.1.2.-Visualize las caracteristicas adicionales de su equipo en la columna "caracteristicas". <br> <br>
                1.1.3.-Para generar su reporte de resguardo de bienes por usuario seleccione aqui.<br> <br>
                1.1.4.-Agrege o elimine fotos a su galeria de equipos  como evidencia, en la columna "galeria". <br>
              
              </h6>
            </div>
            <br>
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">EQUIPOS A MI RESGUARDO</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                    Total de equipos <br>
                         {{{count($equipo)}}}
                   </h5>
                </div>
      
               </div>
            
            </div>
         
         @if(count($equipo)>0)
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Equipo</th>
                      <th>No.Inventario</th>
                      <th>Instalación</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Caracteristicas</th>
                      <th>Tipo de adquisición</th>
                       <th>Observación</th>
                      <th>Agregar/Editar Observación</th>
                      <th>Galeria</th>
          
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Equipo</th>
                      <th>No.Inventario</th>
                      <th>Instalación</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Caracteristicas</th>
                      <th>Tipo de adquisición</th>
                      <th>Observación</th>
                      <th>Agregar/Editar Observación</th>
                      <th>Galeria</th>
                  
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($equipo as $equipos)
                          <tr>
                            <td>{{{$equipos->Categoria}}}</td>
                            <td><a href="{{ route('equipo.show',['id' => $equipos->NoInventario])}}">{{{$equipos->NoInventario}}}</a></td>
                            <td>{{{$equipos->Nomenclatura}}}</td>
                            <td>{{{$equipos->Serie}}}</td>
                            <td>{{{$equipos->Modelo}}}</td>
                            <td>{{{$equipos->Marca}}}</td>
                            @if($equipos->CA==1)
                               <td><center><a href="{{ route('equipo.caracteristicas',['id' => $equipos->NoInventario])}}"><i class="fas fa-eye fa-2x"></i></a></center> </td>
                            @else 
                               <td><center><i class="fas fa-eye-slash fa-2x"></i></center></td>
                            @endif
                            <td>{{{$equipos->TipoAdquisicion}}}</td>
                            <td>{{{$equipos->Observacion2}}}</td>
                            <td>
                              <center>
                                <a href="{{route('equipo.observacion',['id'=> $equipos->NoInventario])}}">
                                  <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                                </a>
                              </center> 
                            </td>
                            <td>
                                <a href="{{{route('galeria.index',['id'=>$equipos->NoInventario])}}}">
                                <center>  
                                   <button type="button" class="boton_EE"><i class="fas fa-camera"></i>/<i class="far fa-images"></i>
                                   </button>
                               </center>
                                </a>
                            </td>
                        
                         </tr> 
                      @endforeach
                  </tbody>
                </table>
                
              </div>
              
            </div>
               @else
                  <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY EQUIPOS  <br>A SU RESGUARDO <br>
                        </div>
                      </center>
                      <br><br>
           @endif
          </div>
           <center><a href="{{ URL::to('/equipo/docente') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
           </center>
        </div>
     </section>

@endsection