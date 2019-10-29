@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>restaurar_equipos</title>

       <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">

            @if(Auth::User()->TipoUsuario==1)
               <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            @else
              <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            @endif
              <li class="breadcrumb-item active">SUBSECCIÓN VISUALIZAR Y RESTAURAR EQUIPOS</li>
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
             @if(Auth::User()->TipoUsuario==1)    

             <center> 3.4 VISUALIZAR Y RESTAURAR EQUIPOS</center>
               <br>
               <br>
                3.4.1.-Visualize el historial detallado por equipo (Estatus,registro,Alta,Baja y Ultima Modificación) seleccionando el No.Inventario de la tabla "Equipos Registrados". <br><br>
                3.4.2.-Escoga todos los equipos que desee restaurar y posteriormente seleccione en el BOTON "Restaurar Equipos".  <br><br>
                3.4.3.- Si desea mover la tabla busque la barra horizontal (scroll) que se encuentra al final.
              @else

                <center> 2.4 VISUALIZAR Y RESTAURAR EQUIPOS</center>
               <br>
               <br>
                2.4.1.-Visualize el historial detallado por equipo (Estatus,registro,Alta,Baja y Ultima Modificación) seleccionando el No.Inventario de la tabla "Equipos Registrados". <br><br>
                2.4.2.-Escoga todos los equipos que desee restaurar y posteriormente seleccione en el BOTON "Restaurar Equipos".  <br><br>
                2.4.3.- Si desea mover la tabla busque la barra horizontal (scroll) que se encuentra al final.

              @endif
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
                    Total de equipos con Estatus "BAJA" <br>
                         {{{$TotalEquipos}}}
                   </h5>
                </div>
      
               </div>
            
            </div>
         
         @if($TotalEquipos!=null)
          <center>
              <br>
              <a href="">
                            
                <button type="submit" class="boton_EE btn btn-primary"  style="height:60%; ">
                     <i class="fas fa-arrow-down"></i>  Lista Excel <i class="fas fa-file-excel"></i>
                  </button>
             </a>
          </center>
            <div class="card-body">
             <form id="re" method="post" action="{{{route('equipo.restaurar')}}}">
               @csrf
               @method('put')
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
                      <th>Restaurar</th>

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
                      <th>Restaurar</th>
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
                              <center>
                                <input  type="checkbox" name ="equipo[]" value="{{{$equipos->NoInventario}}}" style="width: 30px; height: 20px;">
                              </center>
                            </td>
                         </tr> 
                      @endforeach
                  </tbody>
                </table>
                  <center>
                    <input  type="submit" class="informacion boton_EE btn btn-primary" value="Restaurar Equipos">
                  </center> <br>
              </div>
            </form>
               
            </div>
               @else
                  <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY EQUIPOS  <br>CON ESTATUS BAJA<br>
                        </div>
                      </center>
                      <br><br>
           @endif
          </div>
          <center><a href="{{url()->previous()}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
     </section>
     <script type="text/javascript">
         $('#re').submit(function(e){
            if ($('input[name="equipo[]"]:checked').length === 0) {
        e.preventDefault();
        alert('Debe seleccionar al menos un casilla de NoInventario');
    }
  });
     </script>
@endsection