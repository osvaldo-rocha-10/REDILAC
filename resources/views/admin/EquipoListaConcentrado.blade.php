@extends('layouts.app')<!-- Herencia de plantilla blade -->

        <title>lista_concentrado</title>
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
            <li class="breadcrumb-item active">SUBSECCIÓN LISTA DE CONCENTRADO</li>
          </ul>   
        </div>
     </div>

   @if(session('success'))
      <div class="card-body">
                   
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
      </div>
   @endif
 

   @if(session('failures'))

   @php($failures = session('failures'))
          <div class="card-body">

            <ul>
                            <div class="alert alert-danger">
                              <h6>
                               <center>ERROR DE IMPORTACIÓN DE DATOS VERIFIQUE</center>
                                   @foreach ($failures as $failure)
                                          <li>Fila No. {{{$failure->row()}}}
                                               <ul>Columna: "{{{ $failure->attribute()}}}"</ul>
                                               <ul>Informe de errores:
                                               @foreach ($failure->errors() as $error)
                                                       <li> {{{$error}}} </li>
                                                     @endforeach
                                              </ul>
                                           </li>
                                           <hr>   
                                 @endforeach
                                </h6>
                             </div>
              </ul>
                          
        </div>
    @endif

  @if(session('Error'))
          <div class="card-body">
                        
                           
                             <div class="alert alert-danger">
                                  {{ session('Error') }}
                             </div>
                      
                          
          </div>
  @endif
        <section>
         <div class="container-fluid">
          <!-- DataTales Example -->
          <br>
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 7px;">
              <h6 class="m-0 font-weight-bold text-primary">  
                 @if(Auth::User()->TipoUsuario==1)
                   <center>3.2 SUBIR LISTA DE CONCENTRADO</center> <br><br><br>
                    3.2.1-Para dar de alta equipos desde un ARCHIVO EXCEL es necesario seguir los pasos que se mencionan a continuación . <br> <br>
                @else 
                   <center>2.2 SUBIR LISTA DE CONCENTRADO</center> <br><br><br>
                    2.2.1-Para dar de alta equipos desde un ARCHIVO EXCEL es necesario seguir los pasos que se mencionan a continuación . <br> <br>

                @endif
                           &nbsp;&nbsp;  PASO 1: Descargue el formato aqui:
                            <a href="{{ asset('Almacenamiento/Sistema/FormatoExcel_Equipo.xlsx') }}">
                              <u> <h4>FORMATO EXCEL</h4> </u>
                             </a> <br>
                           &nbsp;&nbsp; PASO 2:  Visualize las instrucciones de manera general para importar el Formato Excel en la siguiente liga:   
                            <a href="{{{route('equipo.instrucciones')}}}">
                            <u> <h4> INSTRUCCIONES</h4></u> 
                            </a> o seleccione aqui <a href="{{ asset('Almacenamiento/Sistema/InstruccionesEquipo.txt') }}" download>
                                                       <button type="button" class="boton_EE align-items-left" style="height:25px;">
                                                           <i class="fas fa-download"></i>
                                                      </button>
                            </a> <br> &nbsp;&nbsp; para su descarga. <br>
                            <br>
                           &nbsp;&nbsp;  PASO 3: Extensiones admitidas [.xls,.xlsx,.xslm,.xltx,.xml]. <br> <br>
                           &nbsp;&nbsp;  PASO 4: Seleccione en Examinar para subir su ArchivoExcel. 
                     <br><br>
            <form method="post" action="{{{route('equipo.importar')}}}"  enctype="multipart/form-data">
                    @csrf
                    <center>
                      <label for="ImportExcel" class="subir">
                                Examinar
                      </label>
                      <span id="ActualizarExcel"> Ningún Archivo Seleccionado </span>
                      <input id="ImportExcel" name="Excel"  type="file" style='display: none;'/> <br>
                       <div class="alert alert-danger" style="width: 50%;">
                        <h6 class="m-0 font-weight-bold" >Si tiene problemas al cargar el archivo recargue la pagina nuevamente.</h6>
                       </div>
                     
                   </center>  
                    
                       &nbsp;&nbsp; PASO 5:  Posteriormente seleccione aqui 
                          <button type="submit" class="boton_Excel" style="height:25px;" id="subir" disabled/>
                             <i class="fas fa-cloud-upload-alt"></i>
                         </button>
                         para subir su archivo.
                         
                      </h6>
                  </form>
               
              </h6>
            </div>
         
          
          </div>
           @if(Auth::User()->TipoUsuario==1)
              <center><a href="{{ URL::to('/equipo/administrador') }}">
           @else
              <center><a href="{{ URL::to('/equipo/area') }}">
           @endif
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
        </div>
     </section>

@endsection