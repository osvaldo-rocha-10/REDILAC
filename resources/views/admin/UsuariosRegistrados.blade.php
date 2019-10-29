@extends('layouts.app') <!-- Herencia de plantilla blade -->
 
       <title>usuarios_registrados</title>

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
            <li class="breadcrumb-item active">SUBSECCIÓN USUARIO COORDINADOR</li>
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
                <center>5.1 USUARIO COORDINADOR.</center> <br><br>
                3.5.1- Realice operaciones de  editar o eliminar un tipo de usuario (Coordinador-Administrativo/Coordinador-Area/Coordinador-Docente) <br>
                3.5.2.- Si desea agregar un coordinador seleccione aqui.
                <a href="{{ route('usuario.create') }}">
                   <button type="button" class="boton_EE align-items-left" style="height:25px;" >
                    <i class="fas fa-user-plus"></i>
                  </button>
                </a>
                o busque en el apartado de operaciones del menu principal.
              </h6>
            </div>
            <br>
             @if(count($usuario)>0)
              <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">USUARIO COORDINADOR</h3> </center> <br>

               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                    Coordinadores registrados: <br>{{{count($usuario)}}}
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
                       <th>Fecha de Registro</th>
                       <th>Ultima modificación</th>
                       <th>Restablecer Contraseña</th>
                       <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>idCoordinador</th>
                      <th>Coordinador</th>
                      <th>Tipo de Coordinador</th>
                       <th>Dirección/Academia</th>
                      <th>Fecha de registro</th>
                      <th>Ultima modificación</th>
                      <th>Restablecer Contraseña</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($usuario as $usuarios)
                        <tr>
                           <td>{{{$usuarios->idCoordinador}}}</td>
                           <td>{{{$usuarios->Nombre}}}</td>
                              @if($usuarios->TipoUsuario==1)
                                <td><center>Administrador </center></td>
                              @elseif($usuarios->TipoUsuario==2)
                                 <td><center>Área</center></td>
                              @else
                                <td><center>Docente</center></td>
                              @endif
                            <td>{{{$usuarios->Academia}}}</td>
                            <td>{{{$usuarios->created_at}}}</td>
                            <td>{{{$usuarios->updated_at}}}</td>
            
                            <td> 
                               <a href="{{ route('usuario.resetpassword',['id' =>$usuarios->idCoordinador])}}">
                                  <button type="button" class="boton_EE"><i class="fas fa-key"></i></button>
                               </a>
                          </td>
                          <td>
                            <a href="{{ route('usuario.edit',['id' => $usuarios->idCoordinador])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                          </td>
                          <td>
                            <form method="post" action="{{ route('usuario.destroy', $usuarios->idCoordinador ) }}">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar el UsuarioCoordinador {{{ $usuarios->idCoordinador}}} ')"><i class="far fa-trash-alt"></i></button>
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
                        NO HAY COORDINADORES <br>REGISTRADOS <br>
                        </div>
                      </center>
                      <br><br>
                 @endif
          </div>
          <center><a href="{{ route('usuario.administrador') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
    
     </section>

@endsection