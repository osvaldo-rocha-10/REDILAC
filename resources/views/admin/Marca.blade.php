@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>marcas</title>

       <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
              @if(Auth::User()->TipoUsuario==1)
                <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
              @else
               <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
             @endif
            <li class="breadcrumb-item active">SUBSECCIÓN  MARCAS REGISTRDAS</li>
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
                <center>3.5 CATEGORIAS REGISTRADAS.</center> <br><br>
                3.6.1.- Realice operaciones de  editar o eliminar un tipo de marca en la tabla "MARCAS DE EQUIPO". <br>
                3.6.2.- Si desea agregar una marca  seleccione aqui.
                 <a href="{{ route('marca.create') }}">
                  <button type="button" class="boton_EE align-items-left" style="height:25px;" >
                      <i class="fab fa-mastodon"></i>-> <i class="fas fa-plus-circle"></i>
                    </button>
                  </a>
                o busque en el apartado de operaciones del menu principal.
                @else
                   <center>2.6 CATEGORIAS REGISTRADAS.</center> <br><br>
                @endif
              </h6>
            </div>
            <br>
             @if(count($marca)>0)
              <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">MARCAS DE EQUIPO</h3> </center> <br>
             
               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                    Marcas registradas: <br>{{{count($marca)}}}
                   </h5>
                </div>

               </div>

            </div>
         
            <div class="card-body">
              <div class="table-responsive">
              @if(Auth::User()->TipoUsuario==1)
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Marca</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Marca</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($marca as $marcas)
                        <tr>
                           <td>{{{$marcas->Marca}}}</td>
                           <td>
                            <a href="{{ route('marca.edit',['idMarca' => $marcas->idMarca])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                          </td>
                          <td>
                          <form method="post" action="{{ route('marca.destroy', $marcas->idMarca ) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar la Marca de equipo {{{$marcas->Marca}}}')"><i class="far fa-trash-alt"></i></button>
                            </form>
                           </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                
                @else
                  <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Marca</th>

                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Marca</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($marca as $marcas)
                        <tr>
                           <td>{{{$marcas->Marca}}}</td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                
                @endif
              </div>
            </div>
                  @else
                  <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY MARCAS DE EQUIPO <br>REGISTRADAS <br>
                        </div>
                      </center>
                      <br><br>
                 @endif
          </div>
            @if(Auth::User()->TipoUsuario==1)
              <center><a href="{{ route('equipo.administrador')}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                </a></center>
            @else
               <center><a href="{{ route('equipo.area')}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
            @endif
        </div>
    
     </section>

@endsection