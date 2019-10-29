@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>dirección_academia</title>
       
       <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')  <!-- Sección inicial blade --> 

  <!-- div parte superior izquierda -->
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SECCIÓN DIRECCIÓN Y ACADEMIAS</li>
          </ul>
        </div>
     </div>

     <!-- div mensaje exitoso al realizar una operación desde controlador  -->
      <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

        </div>
        <section>
    <!-- div  contenido de información tabla 1 instrucciones   -->
         <div class="container-fluid">
          <div class="card shadow mb-4">
            
             <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
               <center> 1 DIRECCIÓN Y ACADEMIAS </center>
              
               <br> <br>
                1.1-Realice operaciones de editar o eliminar una academia o dirección de administración escolar en la tabla de "DIRECCIÓN  Y ACADEMIAS". <br>
                1.2-Si desea agregar una nueva dirección o academia de manera individual seleccione aqui   
                    <a href="{{ route('academia.create') }}">
                         <button type="button" class="boton_EE align-items-left" style="height:30px; ">
                           <i class="fas fa-landmark"></i>-><i class="fas fa-plus-circle"></i>
                          </button>
                     </a>
                o busque el apartado de operaciones del menu principal. <br><br>
              
              </h6>
             </div>
             <br>
       <!-- div  contenido de información tabla 2 dirreccion/Academias  -->
            @if(count($academia)>0)
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">DIRECCIÓN Y ACADEMIAS</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;">
                   <h5 class="m-0 font-weight-bold">   
                    Dirección y  Academias registradas <br>
                   {{{count($academia)}}} 
                   </h5>
                </div>

                <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;">
                  <h5 class="m-0 font-weight-bold ">  
                   Instalaciones registradas  <br> {{{$CantidadI}}}
                   
                  </h5>
                </div>

                <div class="col-lg-4">
                  <h5 class="m-0 font-weight-bold">  
                    Equipos registrados <br> {{{$CantidadE}}}
                     
                  </h5>
                  

                </div>
      
               </div>
            </div>
         
    <!-- div contenedor tabla -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Dirección y Academias</th>
                      <th>Coordinador de Area/Administrativo</th>
                      <th>Coordinadores Docentes</th>
                      <th>Instalaciones Registradas</th>
                      <th>Equipos Registrados </th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Dirección y Academias</th>
                      <th>Coordinador de Area/Administrativo </th>
                      <th>Coordinadores Docentes</th>
                      <th>Instalaciones Registradas</th>
                      <th>Equipos Registrados </th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($academia as $academias)
            
                        <tr>

                           <td>{{{$academias->Academia}}}</td>
                           <td>
                              @php($coordinador = array_shift($coordinador_area))
                               @if($coordinador!=null)
                                  <ul>  
                                    <li> {{{$coordinador->idCoordinador}}}-{{{$coordinador->Nombre}}} </li>
                                  </ul>
                               @endif
                           </td>
                           <td> 
                              @php($coordinador = array_shift($coordinador_docente))
                               <ul> 
                                 @foreach ($coordinador as $coordinadores)
                                  <li>  {{{$coordinadores->idCoordinador}}}-{{{$coordinadores->Nombre}}}</li> <br>  
                                 @endforeach
                               </ul>
                           </td>
                           
                           <td>{{{array_shift($instalaciones)}}}</td>
                           <td>{{{array_shift($equipos)}}}</td>
                           <td>
                            <a href="{{ route('academia.edit',['idAcademia' =>$academias->idAcademia])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                          </td>
                          <td>
                          <form method="post" action="{{ route('academia.destroy', $academias->idAcademia ) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar la Dirección o Academia {{{$academias->Academia}}}')"><i class="far fa-trash-alt"></i></button>
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
           <!-- div parte parte inferior si no existe academia -->
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY ACADEMIAS  <br>REGISTRADAS <br>
                        </div>
                      </center>
                      <br><br>
          @endif
     </section>

@endsection