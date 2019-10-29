@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>Procesador</title>

       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Procesador</li>
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


     @if(session('error'))
          <div class="card-body">
                         
                             <div class="alert alert-danger">
                                  {{ session('error') }}
                             </div>     
                          
         </div>
     @endif

        <section>
        @if(count($procesador)>0)
         <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">  
                Instrucciones:  Agrege/Edite/Elimine un procesador de un equipo.
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                   <center> <a href="{{ route('procesador.create') }}"><button type="button" class="boton_EE align-items-left" >
                       <i class="fas fa-microchip"></i>-> <i class="fas fa-plus-circle"></i></button></a></center>
                  <thead>
                    <tr>
                      <th>Procesador</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Procesador</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($procesador as $procesadores)
                        <tr>
                           <td>{{{$procesadores->Procesador}}}</td>
                           <td>
                            <a href="{{ route('procesador.edit',['idProcesador' =>$procesadores->idProcesador])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                          </td>
                          <td>
                          <form method="post" action="{{ route('procesador.destroy', $procesadores->idProcesador ) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar el procesador {{{$procesadores->Procesador}}}')"><i class="far fa-trash-alt"></i></button>
                            </form>
                           </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                    
              </div>
            </div>
          </div>
        </div>
         @else
                      <center> <div style="background:#00b5e2; color: white; height: 40%; width: 40%; border-style: solid; border-color: #003b5c ;">AVISO <br> NO HAY NINGUN PROCESADOR <br>REGISTRADO <br></div></center>
          @endif
     </section>

@endsection