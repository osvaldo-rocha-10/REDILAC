@extends('layouts.app')

       <title>Recursos</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">Inicio</a></li>
            <li class="breadcrumb-item active">SUBSECCIÓN RECURSOS</li>
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
               <center> 4.1 RECURSOS </center>
              
               <br> <br>
                4.1.1-Realice operaciones de editar o eliminar una recurso digital en la tabla de "RECURSOS DIGITALES". <br> <br> 
                4.1.2.-Para asignar o editar competencias busque la columna de "ASIGNAR/EDITAR COMPETENCIAS" de la tabla "RECURSOS DIGITALES". <br>  <br>  
                4.1.3.-Si desea subir un recurso digital seleccione aqui   
                    <a href="{{ route('recurso.create') }}">
                         <button type="button" class="boton_EE align-items-left" style="height:30px; ">
                        <i class="fas fa-chalkboard-teacher"></i>-><i class="fas fa-plus-circle"></i>
                          </button>
                     </a>
                o busque el apartado de operaciones del menu principal. <br><br>
              
              </h6>
             </div>
             <br>
            @if(count($recurso)>0)
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">RECURSOS DIGITALES</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">

                <div class="col-lg-12">
                  <h5 class="m-0 font-weight-bold ">  
                   Recursos registrados  <br> {{{count($recurso)}}}
                  </h5>
                </div>
      
               </div>
            </div>
         

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Categoria</th>
                      <th>Recurso digital</th>
                      <th>Descripción</th>
                      <th>Ubicación</th>
                      <th>Competencias</th>
                     
                      <th>Editar</th>
                      <th>Eliminar</th>
                      <th>Asignar/Eliminar Competencias</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                       <th>Categoria</th>
                       <th>Recurso digital</th>
                       <th>Descripción</th>
                       <th>Ubicación</th>
                       <th>Competencias</th>
                       
                       <th>Editar</th>
                       <th>Eliminar</th>
                       <th>Asignar/Eliminar Competencias</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($recurso as $recursos)
                        <tr>
                            <td>{{{$recursos->categoria}}}</td>
                            <td>
                              <img src="{{ asset('Almacenamiento/Iconos/'.$recursos->icono) }}" alt="person" class="img-fluid rounded-circle" style="width: 25%;">
                              <a href ="{{ asset('Almacenamiento/RecursosDigitales/'.$recursos->recurso) }}"> {{{$recursos->recurso}}} </a>
                            </td>
                            <td>
                              {{{$recursos->descripcion}}}
                            </td>
                             <td>   
                                @php($i = array_shift($instalacion))
                                <ul>
                                @foreach ($i as $instalaciones)
                                    <li>{{{$instalaciones->ins}}}</li>
                                @endforeach
                                </ul>
                             </td>
                             <td><center>{{{array_shift($competencia)}}}</center></td>
                             
                            <td>
                              <a href="{{ route('recurso.edit',['id' =>$recursos->id])}}">
                                <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                              </a>
                            </td>
                            <td>
                            <form method="post" action="{{ route('recurso.destroy', $recursos->id) }}">
                                @csrf
                                @method('DELETE')
                               <button type="submit" class="boton_EE" onclick="return confirm('Desea eliminar el recurso digital [ {{{$recursos->recurso}}} ]') "><i class="far fa-trash-alt"></i></button>
                             </form>
                            </td>
                            <td>
                                <a href="{{ route('recurso.show',['id' =>$recursos->id])}}">
                                <button type="button" class="boton_EE">
                                   <i class="fas fa-traffic-light"></i>/<i class="fas fa-plus-circle"></i>
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
        </div>
         @else
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY RECURSOS  <br>REGISTRADOS <br>
                        </div>
                      </center>
                      <br><br>
          @endif

          
     </section>

      <center><a href="{{ URL::to('/recurso') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
                </center>

@endsection