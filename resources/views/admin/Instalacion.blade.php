@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>instalaciones</title>

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
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
             <li class="breadcrumb-item active">SECCIÓN INSTALACIONES</li>
          </ul>
         
          </span>
        </div>
     </div>
      <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif



        </div>
 

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
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
                   <center>   <h6 class="m-0 font-weight-bold text-primary"> 2 INSTALACIONES  </h6></center> <br><br>
               <div class="row d-flex">
                <div class="col-lg-7" style="border-right-style: solid; border-color: #003B5C ;" >
                   <h6 class="m-0 font-weight-bold text-primary">  
                

                    2.1.-Realice operaciones de editar o eliminar una instalación en la tabla de "INSTALACIONES". <br> <br>
                    2.2-Si desea agregar una instalación a una academia o espacio fisico dentro de una dirrección escolar seleccione aqui
                    <a href="{{ route('instalacion.create') }}">
                       <button type="button" class="boton_EE align-items-left" style="height:25px;">
                        <i class="fas fa-building"></i>-> <i class="fas fa-plus-circle"></i>
                     </button>
                    </a> <br> <br>
                    2.3.-Para dar de alta instalaciones desde un ARCHIVO EXCEL es necesario seguir los pasos que se mencionan a continuación . <br> <br>

                            PASO 1: &nbsp;&nbsp; Descargue el formato aqui:
                            <a href="{{ asset('Almacenamiento/Sistema/Administrador/FormatoExcel_Instalacion.xlsx') }}">
                              <u> <h4>FORMATO EXCEL</h4> </u>
                             </a> <br> <br>
                            PASO 2: &nbsp;&nbsp;  Visualize las instrucciones de manera general para importar el Formato Excel en la siguiente liga:   
                            <a href="{{ route('instalacion.show',1) }}">
                            <u> <h4> INSTRUCCIONES</h4></u> 
                            </a> o seleccione aqui <a href="{{ asset('Almacenamiento/Sistema/Administrador/InstruccionesInstalacion.txt') }}" download>
                                                       <button type="button" class="boton_EE align-items-left" style="height:25px;">
                                                           <i class="fas fa-download"></i>
                                                      </button>
                            </a>  para su descarga. <br>
                            <br>
                            PASO 3: &nbsp;&nbsp; Extensiones admitidas [.xls,.xlsx,.xslm,.xltx,.xml]. <br> <br>
                            PASO 4: &nbsp;&nbsp; Seleccione en Examinar para subir su ArchivoExcel. <br>
       

                     <br><br>
                  <form method="post" action="{{ route('instalacion.importar') }}"  enctype="multipart/form-data">
                    @csrf
                    <center>
                      <label for="ImportExcel" class="subir">
                                Examinar
                      </label>
                      <span id="ActualizarExcel"> Ningún Archivo Seleccionado </span>
                      <input id="ImportExcel" name="Excel"  type="file" style='display: none;'/> <br>
                       <div class="alert alert-danger" style="width: 80%;">
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

                </div>

                <div class="col-lg-5" >
                  <br><br><br><br><br><br>
                   <h6 class="m-0 font-weight-bold text-primary"> 
                       <center> 2.4.-Para visualizar o realizar operaciones de alguna Categoria/Instalación <br><br><br><br>
                              <a href="{{ route('instalacion_categoria.administrador') }}"> Seleccione aqui (CATEGORIAS DE INSTALACIONES)</a></center> 
                      <br>
                      </h6>
                </div>
               </div>
            </div>
            <br>
             <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;"> 
                <center><h3 class="m-0 font-weight-bold " style="color: #003b5c;">INSTALACIONES</h3> </center> <br><br>

               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;">
                   <h5 class="m-0 font-weight-bold">   
                    Total de instalaciones registradas: <br>{{{$total}}}
                   </h5>
                </div>

                <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;">
                  <h5 class="m-0 font-weight-bold ">  
                    Total de equipos registrados: <br> {{{$cantidad}}}
                  </h5>
                </div>
                <div class="col-lg-4">
                  <h5 class="m-0 font-weight-bold ">  
                    <div class="table-responsive">
                      <table  width="100%" cellspacing="0" style="color:#003b5c;">
                        <thead>
                          <tr>
                            <th>Tipo de Instalacion</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                             @foreach ($categoria as $categorias)
                                @php( $totalc= array_shift($TotalCategorias))
                                <tr>
                                  <td>{{{$categorias->Categoria}}}</td>
                                  <td>&nbsp;&nbsp; {{{$totalc}}}</td>
                                </tr>
                             @endforeach
                        </tbody>
                    </table>
                 </div>
                  </h5>
                </div>
               </div>

            </div>
        @if($total>0)
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Edificio</th>
                      <th>Ubicación</th>
                      <th>Dirección/Academia</th>
                      <th>EquiposRegistrados por Instalación</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Edificio</th>
                      <th>Ubicación</th>
                      <th>Dirección/Academia</th>
                      <th>EquiposRegistrados por Instalación</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($instalacion as $instalaciones)
                     <?php 
                                    $totale= array_shift($TotalEquipos);
                      ?>
                      <tr>
                        <td>{{{$instalaciones->Categoria}}}</td>
                        <td>{{{$instalaciones->Nomenclatura}}}</td>
                        <td>{{{$instalaciones->NoEdificio}}}</td>
                        <td>{{{$instalaciones->Ubicacion}}}</td>
                        <td>{{{$instalaciones->Academia}}}</td>
                        <td><center>{{{$totale}}} </center></td>
                        <td>
                            <a href="{{ route('instalacion.edit',['id' => $instalaciones->idInstalacion])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                        </td>
                        <td>
                          <form method="post" action="{{ route('instalacion.destroy', $instalaciones->idInstalacion) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar la Instalación {{{$instalaciones->Nomenclatura}}}')"><i class="far fa-trash-alt"></i></button>
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
                        NO HAY INSTALACIONES  <br>REGISTRADAS <br>
                        </div>
                      </center>
                      <br><br>
          @endif
          </div>
        </div>
     </section>

@endsection