@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>formatos</title>

       <!-- Libreria js -->
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
            <li class="breadcrumb-item active">SUBSECCIÓN FORMATOS</li>
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
      
         <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
                 @if(Auth::User()->TipoUsuario==1)
                   <center>4.2 FORMATOS.</center> <br><br>
                   4.2.1.-Realice operaciones de  editar o eliminar un Formato en la tabla de "FORMATOS". <br> <br>
                   4.2.2.-Para subir un formato seleccione en examinar. <br> <br>
                @else
                   <center>3.2 FORMATOS.</center> <br><br>
                   3.2.1.-Realice operaciones de  editar o eliminar un Formato en la tabla de "FORMATOS". <br> <br>
                   3.2.2.-Para subir un formato seleccione en examinar. <br> <br>
                @endif
                    <center>   &nbsp;&nbsp;  Extensiones admitidas [.pdf, .docx, .doc]. <br> <br>
                     <form method="post" action="{{ route('formato.store') }}" enctype="multipart/form-data">
                       @csrf
                    <center>
                      <label for="FileFormato" class="subir">
                                Examinar
                      </label>
                      <span id="ActualizarFormato"> Ningún Formato Seleccionado </span>
                      <input id="FileFormato" name="Formato"  type="file" style='display: none;'/> <br>
                       <div class="alert alert-danger" style="width: 40%;">
                        <h6 class="m-0 font-weight-bold">Si tiene problemas al cargar el archivo recargue la pagina nuevamente.</h6>
                       </div>
                     
                   </center>  
                    
                       PASO 5: &nbsp;&nbsp; Posteriormente seleccione aqui 
                          <button type="submit" class="boton_Excel" style="height:25px;" id="subir" disabled/>
                             <i class="fas fa-cloud-upload-alt"></i>
                         </button>
                         para subir su archivo.
                         
                      </h6>
                    </form>

                   </center>
              </h6>
            </div>
            <br>
             @if(count($formato)>0)
              <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">FORMATOS</h3> </center> <br>

               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   
                   Total de  Formatos: <br>{{{count($formato)}}}
                   </h5>
                </div>

               </div>

            </div>
          
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Formato</th>
                      <th>Dirección/Academia</th>
                      <th>Fecha</th>
                      <th>Editar Nombre/Formato</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Formato</th>
                      <th>Dirección/Academia</th>
                      <th>Fecha</th>
                      <th>Editar Nombre/Formato</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach ($formato as $formatos)
                        <tr>
                            <td><a href="Almacenamiento/Formatos/{{$formatos->Formato}}" target="_blank" id="rd"> <b>{{{$formatos->Formato}}} </b> </a>
                            </td>
                           <td>{{{$formatos->Academia}}}</td>
                           <td>{{{$formatos->Fecha}}}</td>
                           <td>
                            <a href="{{ route('formato.edit',['idFormato' => $formatos->idFormatos])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                          </td>
                          <td>
                          <form method="post" action="{{ route('formato.destroy', $formatos->idFormatos )}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar el formato especifico  {{{$formatos->Formato}}}')"><i class="far fa-trash-alt"></i></button>
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
                        NO HAY FORMATOS <br>REGISTRADOS  <br>
                        </div>
                      </center>
                      <br><br>
                 @endif
          </div>
               @if(Auth::User()->TipoUsuario==1)
                  <center><a href="{{ route('formato_reporte.administrador') }}">
                 @else
                   <center><a href="{{ route('formato_reporte.area') }}">
                 @endif
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
    
     </section>

@endsection