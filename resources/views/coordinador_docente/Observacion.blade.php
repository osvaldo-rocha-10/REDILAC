@extends('layouts.app')
   
<title>editar_observacion</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.docente') }}">INICIO</a></li>
            <li class="breadcrumb-item active">Agregar/Editar observación</li>
          </ul>
        </div>
     </div>
     <section>
      <div class="container-fluid">
          <!-- DataTales Example -->
          <br>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
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
                   <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
               1.-Agrege o edite un observacion del equipo seleccionado.<br> 
               2.-Limite de caracteres 400. <br>
               3.-Seleccione en "Guardar cambios".


                </span> <br><br>
               <form method="post" action="{{route('equipo.observacion_update',$equipo->NoInventario)}}"  style="color:  #003b5c;">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                            <label for="Observacion" class="col-md-4 col-form-label text-md-right">
                            {{ __('Observación:') }}
                          
                            </label>

                              <div class="col-md-6">
                                    <textarea rows='1' class="form-control" name="Observacion" style="height: 150px;">{{{$equipo->Observacion2}}}</textarea>
                             </div>
                    </div>
                    <hr>

                   <center><button type="submit" class="boton_EE btn btn-primary">Guardar cambios</button></center>
                 </form>

                 <a href="{{ URL::to('/equipo/docente/1.1') }}">
                  <button type="button" class="boton_EE btn btn-primary">
                    <i class="fas fa-reply">
                    </i> Regresar
                   </button>
                 </a>
                 
            </div>
          </div>
        </div>
     </section>

 
@endsection