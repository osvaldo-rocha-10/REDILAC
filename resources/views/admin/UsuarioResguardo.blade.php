@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>resguardo_equipos</title>

       <!-- Liberias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SUBSECCIÓN RESGUARDO DE BIENES POR USUARIO</li>
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
                <center>5.2 RESGUARDO DE BIENES POR USUARIO.</center> <br><br>
                5.2.1.-Visualize el total de equipos en resguardo por usuario. <br> <br>
                5.2.3.-Seleccione un Equipo en la columna "Lista de equipos en resguardo" de la tabla RESGUARDO DE BIENES POR USUARIO y visualize la información de cada equipo asignado por coordinador. <br><br>
                5.2.4 Si desea asignar equipos para un coordinador seleccione en la columna  "Asignar equipos". <br><br>
                5.2.5 Si desea eliminar equipos para un coordinador seleccione en la columna "Eliminar equipos".
              </h6>
            </div>
            <br>
              <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">RESGUARDO DE BIENES POR USUARIO</h3> </center> <br>

               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                   </h5>
                </div>

               </div>

            </div>
          
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                        <th>idCoordinador</th>
                        <th>Coordinador</th>
                        <th>Tipo de Coordinador</th>
                        <th>Dirección/Academia</th>
                        <th>Lista de equipos en resguardo</th>
                        <th>Total de equipos</th>
                        <th>Asignar Equipos</th>
                        <th>Eliminar Equipos</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                        <th>idCoordinador</th>
                        <th>Coordinador</th>
                        <th>Tipo de Coordinador</th>
                        <th>Dirección/Academia</th>
                        <th>Lista de equipos en resguardo</th>
                        <th>Total de equipos</th>
                        <th>Asignar Equipos</th>
                        <th>Eliminar Equipos</th>
                    </tr>
                  </tfoot>
                   <tbody>
                    @foreach ($usuario as $usuarios)
                         <tr>
                             <td>{{{$usuarios->idCoordinador}}}</td>
                             <td>{{{$usuarios->Nombre}}}</td>
                             <td>
                               @if($usuarios->TipoUsuario==1)
                                   Administrador
                               @elseif($usuarios->TipoUsuario==2)
                                   Area
                               @elseif($usuarios->TipoUsuario==3)
                                  Docente
                               @endif
                             </td>
                             <td>{{{$usuarios->Academia}}}</td>
                             <td>
                                @php($equipo = array_shift($TotalEquipo))
                                @php($contador = 0)
                                @if(count($equipo)!=0)
                                  @foreach ($equipo as $equipos)
                                       <a href="{{ route('usuario.informacion',['id' =>$equipos->Equipos_NoInventario])}}"> {{{  $equipos->Equipos_NoInventario}}}</a> 
                                          @if($loop->remaining)
                                              ,
                                          @endif
                                 @endforeach
                                @else
                                  SN/EQUIPOS
                                @endif
                             </td>
                             <td>{{{count($equipo)}}}</td>
                              <td>
                              
                               <a href="{{ route('usuario.equipo_lista',['id_coordinador' =>$usuarios->idCoordinador,'id_academia'=>$usuarios->idAcademia,'academia'=>$usuarios->Academia])}}">
                                <button type="button" class="boton_EE">
                                   <i class="fas fa-database"></i>/<i class="fas fa-plus-circle"></i>
                                </button>
                              </a>
                            </td>

                            <td>
                              <a href="{{ route('usuario.equipo_lista_e',
                                              ['id_coordinador' =>$usuarios->idCoordinador,
                                               'id_academia'=>$usuarios->idAcademia,
                                               'academia'=>$usuarios->Academia,
                                               'coordinador'=>$usuarios->Nombre]
                                )}}">
                                <button type="button" class="boton_EE">
                                   <i class="fas fa-database"></i>/<i class="fas fa-minus-circle"></i>
                                </button>
                              </a>
                            </td>
                         </tr>
                    @endforeach
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
          <center><a href="{{ route('usuario.administrador')}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
    
     </section>

@endsection