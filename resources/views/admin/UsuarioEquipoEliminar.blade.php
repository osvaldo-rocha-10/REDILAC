@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>eliminar_equipos</title>


       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
              <li class="breadcrumb-item active">ELIMINAR EQUIPOS</li>
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
           <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
               <center>COORDINADOR {{{$id_coordinador}}} - {{{$coordinador}}} <br>
                                   {{{$academia}}}

               </center> <br>

               1.-Dar click en las casillas para eliminar un equipo asignado. <br> <br>
               2.-Seleccione  "guardar cambios" para procesar su solicitud. <br><br>

                 <input type="checkbox" onclick="marcar(this);" style="width: 30px; height: 20px;">Seleccionar todos
              </h6>
            </div>

            @if(count($equipo)>0)
            <div class="card-body">
            <form method="post" action="{{ route('usuario.eliminar_lista',$id_coordinador) }}" id="ue">
               @csrf
               @method('put')
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>No.Inventario</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Tipo de Equipo</th>
                      <th>Instalación</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>No.Inventario</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Marca</th>
                      <th>Tipo de Equipo</th>
                      <th>Instalación</th>
                       <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>

                      @foreach ($equipo as $equipos)
                        <tr>
                            <td>{{{$equipos->NoInventario}}}</td>
                            <td>{{{$equipos->Serie}}}</td>
                            <td>{{{$equipos->Modelo}}}</td>
                            <td>{{{$equipos->Marca}}}</td>
                            <td>{{{$equipos->Categoria}}}</td>
                            <td>{{{$equipos->Nomenclatura}}}</td>

                            <td><input type="checkbox" name ="equipo[]" 
                                   value="{{{$equipos->NoInventario}}}" style="width: 30px; height: 20px;"></td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
                <center><button type="submit" class="boton_EE btn btn-primary">Guardar cambios</button></center>
             </form>
              
            </div>
          </div>
              @else
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY EQUIPOS <br>ASIGNADOS. <br>
                        </div>
                      </center>
                      <br><br>
          @endif
              <a href="{{ URL::to('usuario/administrador/5.2') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
        </div>
     
   
     </section>

      <script type="text/javascript">
       
         $('#ue').submit(function(e){
           if ($('input[name="equipo[]"]:checked').length === 0) {
            e.preventDefault();
            alert('Debe seleccionar al menos un equipo');
        }
      });
     </script>

@endsection