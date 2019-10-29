@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>equipos_registrados</title>

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
            <li class="breadcrumb-item active">SUBSECCIÓN EQUIPOS REGISTRADOS</li>
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
             <center> 3.1 EQUIPOS REGISTRADOS </center>
               <br>
               <br>

                3.1.1-Realice operaciones de editar , eliminar o  dar de baja un equipo  en la tabla de "EQUIPOS REGISTRADOS". <br>
                3.1.2-Si desea agregar un equipo de manera individual seleccione aqui   
                    <a href="{{ route('equipo.create') }}">
                         <button type="button" class="boton_EE align-items-left" style="height:30px; ">
                            <i class="fas fa-hdd"></i>-> <i class="fas fa-plus-circle"></i>
                          </button>
                     </a>
                o busque el apartado de operaciones del menu principal. <br><br>
                3.1.3.-Visualize el historial detallado por equipo (Estatus,registro,Alta,Baja y Ultima Modificación) seleccionando el No.Inventario de la tabla "Equipos Registrados". <br><br>

                3.1.4.-Para registrar una Categoria de equipo busque la subsección "REGISTRO DE CATEGORIAS POR EQUIPO" en esta misma sección.  <br><br>
                3.1.5.- Para registrar una Marca de equipo busque la subsección "MARCAS REGISTRADAS" en esta misma sección. <br> <br>
                3.1.6.- Para las categorias de equipo "
                     <b> @foreach($TipoEquipo as $categorias) 
                            @if($categorias->CA == 1)
                               {{$categorias->Categoria}}

                               @if($loop->remaining)
                                     /
                               @endif
                            @endif
                         @endforeach"
                     </b> 
                      , seleccione en los iconos de este estilo  <i class="fas fa-eye "></i> que se encuentran en la columna "Caracteristicas Adicionales".<br><br>
                3.1.7  Para restaurar un equipo en  Baja-Temporal busque  la subsección "EQUIPOS BAJA TEMPORAL" de esta misma sección. <br><br>
                3.1.8  Si desea mover la tabla busque la barra horizontal (scroll) que se encuentra al final.
              
              </h6>
            </div>
            <br>
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">EQUIPOS REGISTRADOS</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12" style="border-right-style: solid; border-color: #003B5C ;">
                   <h5 class="m-0 font-weight-bold">   
                    Total de equipos registrados <br>
                         {{{$TotalEquipos}}}
                   </h5>
                </div>
      
               </div>
            
            </div>
         
         @if($Total!=0)
          <center>
              <br>
              <a href="">
                            
                <button type="submit" class="boton_EE btn btn-primary"  style="height:60%; ">
                     <i class="fas fa-arrow-down"></i>  Lista Excel <i class="fas fa-file-excel"></i>
                  </button>
             </a>
          </center>
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
                      <th>Caracteristicas  Adicionales</th>
                      <th>TipoAdquisición</th>
                      <th>Observación1</th>
                      <th>Observación2</th>
                      <th>Editar</th>
                      <th>Baja <br>Temporal</th>
                      <th>Eliminar</th>

                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                     <th>Tipo de Equipo</th>
                      <th>No.Inventario</th>
                      <th>Instalación</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Caracteristicas  Adicionales</th>
                      <th>TipoAdquisición</th>
                      <th>Observación1</th>
                      <th>Observación2</th>
                      <th>Editar</th>
                      <th>Baja <br>Temporal</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($equipo as $equipos)
                          <tr>
                            <td>{{{$equipos->Categoria}}}</td>
                            <td><a href="{{ route('equipo.show',['id' => $equipos->NoInventario])}}">{{{$equipos->NoInventario}}} </a></td>
                            <td>{{{$equipos->Nomenclatura}}}</td>
                            <td>{{{$equipos->Serie}}}</td>
                            <td>{{{$equipos->Modelo}}}</td>
                            <td>{{{$equipos->Marca}}}</td>
                            @if($equipos->CA==1)
                               <td><center><a href="{{ route('equipo.caracteristicas',['id' => $equipos->NoInventario])}}"><i class="fas fa-eye fa-2x"></i></a></center> </td>
                            @else 
                               <td><center><i class="fas fa-eye-slash fa-2x"></i></center> </td>
                            @endif

                            
                            <td>{{{$equipos->TipoAdquisicion}}}</td>
                            <td>{{{$equipos->Observacion1}}}</td>
                            <td>{{{$equipos->Observacion2}}}</td>
                            <td>
                                <a href="{{ route('equipo.edit',['id' => $equipos->NoInventario])}}">
                                  <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                                </a>
                             </td>
                             <td>
                               <a href="{{ route('equipo.baja',['id' => $equipos->NoInventario])}}">
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea dar Baja el equipo con NoInventario {{{$equipos->NoInventario}}}')"><i class="fas fa-arrow-down"></i></button>
                              </a>
                             </td>
                         
                          <td>
                            <form method="post" action="{{ route('equipo.destroy', $equipos->NoInventario) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar el equipo con NoInventario {{{$equipos->NoInventario}}} del sistema')"><i class="far fa-trash-alt"></i></button>
                            </form>
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
                        NO HAY EQUIPOS  <br>REGISTRADOS <br>
                        </div>
                      </center>
                      <br><br>
             @endif

          </div>
              <center><a href="{{ URL::to('/equipo/administrador') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
     </section>

@endsection