@extends('layouts.app')    <!-- Herencia de plantilla blade -->
   
  <title>AgregarRelación</title>
  <!-- Librerias js -->
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@section('content')      <!-- Sección inicial blade --> 
<style type="text/css">

</style>
 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">RelacionLaboratorio</li>
          </ul>
        </div>
     </div>
     
        <section>
  <!-- div principal -->
         <div class="container-fluid">
          <br>
        <!-- div  informacion 1 -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                Recurso Seleccionado:  "{{{$seleccionRecurso->RecursoDigital}}}"
              </h6>
            </div>

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
     <!-- Instrucciones -->
               <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
                1.-Seleccione la instalación para asignar el recurso-digital. <br>
                </span>
                <br> <br>
                 <center><input type="checkbox" id="mt" onclick="marcar(this);" style="width: 30px; height: 20px;"> 
                   
                 <b id="marcar">Marcar Todos</b></center>
     <!-- Formulario  -->
                <form method="post" action="{{ route('relacion.almacenar',$seleccionRecurso->idRecursoDigital) }}">
                    @method('put')
                    @csrf 
                    <div class="form-group row">
                              <div class="col-md-12">
                                <table width="100%">
                                    <thead>
                                       <tr>
                                          <th>Nomenclatura <hr></th>
                                          <th>Tipo de Instalación/Infraestructura/Laboratorio <hr></th>
                                          <th><b>Asignar</b><hr></th>
                                      </tr>
                                    </thead>
                                    <hr>
                                     @php ($existe=0)
                                      @foreach ($infraestructura as $infraestructuras)
                                          @php ($ban = 0)

                                          @foreach($recurso as $recursos)
                                                  @if ($recursos->Infraestructura_idInfraestructura==$infraestructuras->idInfraestructura)
                                                          @php ($ban = 1)
                                                          @break
                                                  @endif 
                                          @endforeach

                                          @if($ban==0)
                                             @php($existe=1)
                                            <tr>
                                              <td>{{{$infraestructuras->Nomenclatura}}} <hr></td>
                                              <td>{{{$infraestructuras->Categoria}}} <hr></td>
                                              <td><input type="checkbox" name="infraestructura[]" style="width: 30px; height: 20px;" value="{{{$infraestructuras->idInfraestructura}}}"> <hr></td>
                                            </tr>  
                                          @endif
                                      @endforeach
                                   @if($existe==0)
                                          <center> <div style="background:#00b5e2; color: white; height: 40%; width: 40%; border-style: solid; border-color: #003b5c ;"> NO HAY INSTALACIÓNES<br>POR ASIGNAR <br></div></center>
                                          <script type="text/javascript">
                                             $('#mt').css('display', 'none');
                                             $('#marcar').css('display', 'none');
                                          </script>
                                   @endif
                                </table>
                             </div>
                    </div>

                   <center><button type="submit" id="b" class="boton_EE">Asignar</button></center>
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