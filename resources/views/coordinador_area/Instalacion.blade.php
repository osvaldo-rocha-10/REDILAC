@extends('layouts.app')

       <title>instalaciones</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
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


        <section>
         <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
                   <center>   <h6 class="m-0 font-weight-bold text-primary"> 1 INSTALACIONES  </h6></center> <br>
               <div class="row d-flex">
                <div class="col-lg-6" style="border-right-style: solid; border-color: #003B5C ;">
                   <h6 class="m-0 font-weight-bold text-primary">  
                    <center>1.1.-Visualize el total de equipos registrados por INSTALACIÓN de la academia de {{{$academia->Academia}}} en la tabla de "INSTALACIONES". </center><br> <br>
                </div>
                <div class="col-lg-6" >
                   <h6 class="m-0 font-weight-bold text-primary"> 
                       <center> 1.2.-Si dese visualizar alguna Categoria de Instalación <br><br>
                           <a href="{{ route('instalacion_categoria.area') }}"> Seleccione aqui (CATEGORIAS DE INSTALACIONES)</a></center>
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
                    Total de instalaciones registradas: <br> {{{count($instalacion)}}}
                   </h5>
                </div>

                <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;">
                  <h5 class="m-0 font-weight-bold ">  
                    Total de equipos registrados: <br>  {{{$total_equipos}}}
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
                              @foreach ($tipo_instalacion as $tipos)
                              <tr>
                                   <td>{{{$tipos->Categoria}}}</td>
                                   <td>{{{array_shift($categoria)}}}</td>
                              </tr>
                              @endforeach
                        </tbody>
                    </table>
                 </div>
                  </h5>
                </div>
               </div>

            </div>
        @if(count($instalacion)>0)
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Edificio</th>
                      <th>Ubicación</th>
                      <th>Equipos Registrados por Instalación</th>
                      <th>Recursos Registrador por Instalación</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Tipo de Instalación</th>
                      <th>Nomenclatura</th>
                      <th>No.Edificio</th>
                      <th>Ubicación</th>
                      <th>EquiposRegistrados por Instalación</th>
                      <th>Recursos Registrados por Instalación</th>
                    </tr>
                  </tfoot>
                  <tbody>
                   @foreach ($instalacion as $instalaciones)
                      <tr>
                        <td>{{{$instalaciones->Categoria}}}</td>
                        <td>{{{$instalaciones->Nomenclatura}}}</td>
                        <td>{{{$instalaciones->NoEdificio}}}</td>
                        <td>{{{$instalaciones->Ubicacion}}}</td>
                        <td><center>{{{array_shift($equipos)}}}</center></td>
                        <td><center>{{{array_shift($recursos)}}}</center></td>
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