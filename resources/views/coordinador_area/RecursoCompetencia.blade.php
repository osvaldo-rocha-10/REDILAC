@extends('layouts.app')

       <title>agregar_competencias</title>
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
              <li class="breadcrumb-item active">AGREGAR COMPETENCIAS</li>
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
           <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
               <center>Recurso: {{{$recurso->RecursoDigital}}}</center> <br>
               1.-Dar click en las casillas para agregar o eliminar una competencia. <br> <br>
               2.-Seleccione  "guardar cambios" para procesar su solicitud. <br>
              </h6>
            </div>

            @if(count($competencia)>0)
            <div class="card-body">
            <form method="post" action="{{ route('recurso.update_competencia', $recurso->idRecursoDigital) }}" id="ac">
               @csrf
               @method('put')
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Numero de Competencia</th>
                      <th>Descripción de competencia</th>
                      <th>Tipo de Competencia</th>
                      <th>Disciplina</th>
                      <th>Agregar/Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Numero de Competencia</th>
                      <th>Descripción de competencia</th>
                      <th>Tipo de Competencia</th>
                      <th>Disciplina</th>
                      <th>Agregar o Eliminar</th>
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
                             <center>
                              @php($ban = 0)
                                 @foreach ($competencia_recurso as $cr)
                                      @if($cr->nc == $competencias->NumeroCompetencia)
                                         <input type="checkbox" name ="actualizadas[]" value="{{{$competencias->NumeroCompetencia}}}"
                                         style="width: 30px; height: 20px;" checked="checked">
                                            @php($ban = 1)
                                       @break;
                                     @endif
                                 @endforeach
          
                               @if($ban == 0)
                                   <input type="checkbox" name ="competencia[]" 
                                   value="{{{$competencias->NumeroCompetencia}}}" style="width: 30px; height: 20px;">
                               @endif

                            </center>
                           </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
                <center><button type="submit" class="boton_EE btn btn-primary">Guardar cambios</button></center>
             </form>
                 <a href="{{ URL::to('/recurso/area/5.1') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
            </div>
          </div>
        </div>
         @else
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY COMPETENCIAS <br>REGISTRADAS. <br>
                        </div>
                      </center>
                      <br><br>
          @endif

     </section>

      <script type="text/javascript">
       
         $('#ac').submit(function(e){
           if ($('input[name="competencia[]"]:checked').length === 0) {
            e.preventDefault();
            alert('Debe seleccionar al menos una competencia');
        }
      });
     </script>

@endsection