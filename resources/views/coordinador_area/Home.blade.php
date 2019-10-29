@extends('layouts.app')
   
@section('content')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    </div>
     <!-- Counts Section -->
      <center> <h2 style="color:  #003b5c;"> {{{$Academia->Academia}}}  </h2> </center> 
      <section class="dashboard-counts section-padding">
      
          <div class="container-fluid"  style="color:  #003b5c;">
          <div class="row">

            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-building"></i></div>
                <div class="name"><strong class=""><b>INSTALACIONES</b></strong><br><br><span>Total</span>
                  <div class="count-number">{{{$Instalaciones}}}</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-database"></i></div>
                <div class="name"><strong class=""><b>EQUIPOS REGISTRADOS</b></strong><br><span>Total</span>
                  <div class="count-number">{{{$Equipos}}}</div>
                </div>
              </div>
            </div>
               <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-arrow-circle-down"></i></div>
                <div class="name"><strong class=""> <b>EQUIPOS CON ESTATUS BAJA</b>
                 </strong><br><span>Total</span>
                  <div class="count-number">{{{$EquiposBaja}}}</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="far fa-file"></i></div>
                <div class="name"><strong class=""><b>FORMATOS ESPECIFICOS</b></strong><br><span>Total</span>
                  <div class="count-number">{{{$Formatos}}}</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-file-contract"></i></div>
                <div class="name"><strong class=""><b>REPORTES</b></strong><br><br><span>Total</span>
                  <div class="count-number">{{{$Reportes}}}</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
         
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <div class="name"><strong class=""> <b>RECURSOS DIGITALES</b>
                 </strong><br><span>Total</span>
                  <div class="count-number">{{{$Recursos}}}</div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </section>
        <section class="dashboard-header section-padding">
          <div class="container-fluid">
             <div class="row d-flex align-items-md-stretch">
                  <div class="col-lg-6 col-md-12 flex-lg-last flex-md-first align-self-baseline" style="background: #003b5c"> 
                      <h2 class="display h4" style="background :#003b5c; color: #00b5e2; text-align: center;">GRAFICA</h2>
                       <p></p>
                      <div class="card sales-report" id="piechart_3d" style="width: 600px; height: 400px;">
                            <script type="text/javascript">
                                google.charts.load("current", {packages:["corechart"]});
                                google.charts.setOnLoadCallback(drawChart);
                                    function drawChart() {
                                         var data = google.visualization.arrayToDataTable([
                                        ['Task', 'Hours per Day'],
                                        ['Instalaciones',{{{$Instalaciones}}}],
                                        ['Equipos',{{{$Equipos}}}],
                                        ['EquiposBaja',{{{$EquiposBaja}}}],
                                        ['Formatos Especificos',{{{$Formatos}}}],
                                        ['Reportes',{{{$Reportes}}}],
                                        [ 'Recursos',{{{$Recursos}}}],


                                     ]);

                                  var options = {
                                   title: 'INFORMACIÓN GENERAL',
                                   is3D: true,
                                  };

                                 var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                 chart.draw(data, options);
                               }
                            </script>
                     </div>
                 </div>
        <div class="col-lg-1 col-md-1">
           
            </div>
                 <div class="col-lg-5 col-md-5"> 
                      <div class="card to-do" style="background: #003b5c; border-color: #00b5e2;  border-width: 3px;" >
                          <h2 class="display h1" style="text-align: center;  color: #00b5e2;">REDILAC-EMS</h2>
                            
                              <h6 style="color: white;">
                              <center style=" color: #00b5e2;">Instrucciones generales:<br> <br></center>
                              </h6>
                              <h6 class="display h6" style=" color: #00b5e2;">
                                1.- En la parte superior encontrara información del control de los espacios e instalaciones de la Academia de {{{$Academia->Academia}}}. <br> <br>
                                2.- Para generar y registrar reportes solicitados por el plantel seleccione en la parte inferior izquierda en consultas y reportes ó busque la sección de Reportes y Formatos Especificos del menu principal. <br><br>
                                3.-Cada sección del menu principal cuenta con subsecciones , por lo cual es recomendable seguir los pasos necesarios para encontrar la información deseada. <br> <br>

                                4.-Todas las tablas de información del sistema REDILAC-EMS manejan la misma estructura ,por lo tanto, si desea ampliar la información de la tabla, seleccione show  
                                 o cambie de tabla con previous como se muestra a continuación:
                                 <br> <br>
                                <center><img src="{{ asset('img/show.png') }}" style="height:60px;"> / <img src="{{ asset('img/previous.png') }}" style="height:40px;"> </center> <br> <br>5.- Tambien puede realizar busquedas especificas de alguna columna con :  
                                 <center><img src="{{ asset('img/busqueda.png') }}" style="height:40px;">
                                               
                                 </center>


                               </h6>
                    </div>
                </div>
             </div>
        </div>
      </section>

      <!-- Statistics Section-->
      <section class="statistics">
        <div class="container-fluid">
          <div class="row d-flex">
            <div class="col-lg-4" onclick="location.href='{{ route('reporte.area_3.1') }}';">
              <!-- Income-->
              <div class="card income text-center marcado">
                 <div class="icon">
                     <!--<img src="img/IconosRedilac/reportes.png">-->
                     <i class="fas fa-file-contract"></i>
                 </div>
                <div class="number">
                	
                </div>
                <strong class="strongstyle">Consultas y Reportes</strong>
                <p></p>
              </div>
            </div>
            <div class="col-lg-4" onclick="location.href='{{ route('formato.area_3.2') }}';">
              <!-- Income-->
              <div class="card income text-center marcado">
                <div class="icon">
                    <!-- <i class="icon-line-chart">
                     </i> -->
                     <!--<img src="img/IconosRedilac/formato.png">-->
                     <i class="fas fa-file"></i>
                 </div>
                <div class="number">
                	
                </div>
                   <strong class="strongstyle" >FormatosEspecificos</strong>
                <p></p>
              </div>
            </div>

      
          <div class="col-lg-4" onclick="location.href='{{ route('operacion.area') }}';">
              <!-- Income-->
        
               <div class="card income text-center marcado" >
                <div class="icon">
                    <!-- <i class="icon-line-chart">
                     </i> -->
                     <!--<img src="img/IconosRedilac/operacion.png">-->
                     <i class="fas fa-cogs"></i>
                 </div>
                <div class="number">
                  
                </div>
                 <strong class="strongstyle">Operaciones</strong>
              <p></p>
               </div>
            </div>
       
           
            
          </div>
        </div>
      </section>

@endsection
