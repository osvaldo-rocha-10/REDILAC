@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>Competencias</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content') <!-- Sección inicial blade -->

  <!-- div parte superior izquierda -->
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">Inicio</a></li>
              <li class="breadcrumb-item active">SUBSECCIÓN COMPETENCIAS</li>
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
        
        <!-- div instrucciones  -->
         <div class="container-fluid">
          <div class="card shadow mb-4">
            
             <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
               <center> 6.5 COMPETENCIAS </center>
              
               <br> <br>
               6.5.1.-Realice operaciones de editar o eliminar una competencia en la tabla de "COMPETENCIAS".<br><br>
               6.5.2.-Para visualizar o realizar alguna categoria de instalacion 
                <a href="{{ route('competencia_categoria.index') }}">  SELECCIONE AQUI (CATEGORIAS DE COMPETENCIAS)</a> <br><br>
               6.5.3.-Si desea agregar alguna de descripcion de competencia seleccione aqui 
                  <a href="{{ route('competencia.create') }}">
                       <button type="button" class="boton_EE align-items-left" style="height:25px;">
                         <i class="fas fa-traffic-light"></i>-> <i class="fas fa-plus-circle"></i>
                     </button>
                    </a> <br>
               <br><br>
              
              </h6>
             </div>
             <br>
            @if(count($competencia)>0)
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">COMPETENCIAS</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">

                <div class="col-lg-12">
                  <h5 class="m-0 font-weight-bold ">  
                   Competencias Registradas  <br> 
                      {{{count($competencia)}}}
                  </h5>
                </div>
      
               </div>
            </div>
         

         <!-- div tabla responsiva  -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Numero de Competencia</th>
                      <th>Descripción de competencia</th>
                      <th>Tipo de Competencia</th>
                      <th>Disciplina</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Numero de Competencia</th>
                      <th>Descripción de competencia</th>
                      <th>Tipo de Competencia</th>
                      <th>Disciplina</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                
                      @foreach ($competencia as $competencias)
                        <tr>
                           <td>{{{$competencias->NumeroCompetencia}}}</td>
                           <td>{{{$competencias->DescripcionCompetencia}}}</td>
                           <td>{{{$competencias->TipoCompetencia}}}</td>
                           <td>{{{$competencias->Disciplina}}}</td>
                           <td>
                              <a href="{{ route('competencia.edit',['id' => $competencias->NumeroCompetencia])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                           </td>
                           <td>
                              <form method="post" action="{{ route('competencia.destroy',$competencias->NumeroCompetencia) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar el numero de competencia con {{{$competencias->NumeroCompetencia}}}')"><i class="far fa-trash-alt"></i></button>
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
          <!-- div parte parte inferior si no existe competencia-->
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY COMPETENCIAS <br>REGISTRADAS. <br>
                        </div>
                      </center>
                      <br><br>
          @endif

            <center><a href="{{ URL::to('/operacion/administrador') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>

     </section>

@endsection