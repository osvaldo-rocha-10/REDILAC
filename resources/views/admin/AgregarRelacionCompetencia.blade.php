@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>AgregarRelación</title>

  <!-- Librerias js -->
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@section('content')  <!-- Sección inicial blade --> 
<style type="text/css">

</style>
 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">RelacionComptencia</li>
          </ul>
        </div>
     </div>
    
        <section>
          <!-- div  principal -->
         <div class="container-fluid">
          <br>
     <!-- div  informacion 1  -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Recurso Seleccionado:  "{{{$seleccionRecurso->RecursoDigital}}}"
              </h6>
            </div>

      <!-- div lista de errores  "REGLAS DE VALIDACIÓN"  devueltas desde el controlador "COMPETENCIA CONTROLLER"  -->
            <div class="card-body">
                 @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                               @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                              @endforeach
                           </ul>
                      </div>
                @endif

               <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
                1.-Seleccione en las casillas las competencias disponibles <br>
                </span>
                <br> <br>
                 <center><input type="checkbox" id="mt" onclick="marcar(this);" style="width: 30px; height: 20px;"> 
                   
                 <b id="marcar">Marcar Todos</b></center>

           <!-- Formulario  -->
                <form method="post" action="{{ route('relacion.guardar',$seleccionRecurso->idRecursoDigital) }}">
                    @method('put')   <!--Metodo put -->
                    @csrf            <!-- token de seguridad -->
                    <div class="form-group row">
                              <div class="col-md-12">
                                <table width="100%">
                                    <thead></thead>
                                    <hr>
                                     @php ($existe=0)
                                      @foreach ($competencia as $competencias)
                                          @php ($ban = 0)

                                          @foreach($recurso as $recursos)
                                                  @if ($recursos->DescripcionCompetencia_NumeroCompetencia==$competencias->NumeroCompetencia)
                                                          @php ($ban = 1)
                                                          @break
                                                  @endif 
                                          @endforeach

                                          @if($ban==0)
                                             @php($existe=1)
                                            <tr>
                                              <td>{{{$competencias->NumeroCompetencia}}}.- <hr></td>
                                              <td>{{{$competencias->DescripcionCompetencia}}} <hr></td>
                                              <td>{{{$competencias->TipoCompetencia}}} <hr></td>
                                              <td><input type="checkbox" name="competencia[]" style="width: 30px; height: 20px;" value="{{{$competencias->NumeroCompetencia}}}"> <hr></td>
                                            </tr>  
                                          @endif
                                      @endforeach
                                   @if($existe==0)
                                          <center> <div style="background:#00b5e2; color: white; height: 40%; width: 40%; border-style: solid; border-color: #003b5c ;"> NO HAY COMPETENCIAS<br>DISPONIBLES <br></div></center>
                                          <script type="text/javascript">
                                             $('#mt').css('display', 'none');
                                             $('#marcar').css('display', 'none');
                                          </script>
                                   @endif
                                </table>
                             </div>
                    </div>


                   <center><button type="submit" id="b" class="boton_EE">Agregar</button></center>
                       
                        @if($existe==0)
                        <script type="text/javascript">
                           $('#b').css('display', 'none');
                        </script>
                        @endif
                 </form>
                  <a href="{{url()->previous()}}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
            </div>
          </div>
        </div>
     </section>

 
@endsection