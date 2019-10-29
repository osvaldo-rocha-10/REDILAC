@extends('layouts.app') <!-- Herencia de plantilla blade -->
  
<title>CaracteristicasEspecificas</title>

@section('content')   <!-- Sección inicial blade -->

<style>
  #target{
    display: none;
  }
</style>

 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
             @if(Auth::User()->TipoUsuario==1)
               <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">Inicio</a></li>
            @else
              <li class="breadcrumb-item"><a href="{{ route('home.area') }}">Inicio</a></li>
            @endif
            <li class="breadcrumb-item active">C-A</li>
          </ul>
        </div>
     </div>
     
        <section>
         <div class="container-fluid">
          <br>
          <div class="card shadow mb-4" style="color:  #003b5c;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
             <br>
             <center> <span style=" background: #003b5c; color: #00b5e2;">Caracteristicas-Adicionales</span></center>
             <br>
             <br>

                    <div class="form-group row">
                            <label for="SistemaOperativo" class="col-md-4 col-form-label text-md-right">
                          {{ __('SistemaOperativo:') }}
                            </label>

                              <div class="col-md-6">
                                 @if($equipo->SistemaOperativo != NULL)
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$equipo->SistemaOperativo}}}"  readonly="readonly" />
                                 @endif
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Tipo de Sistema" class="col-md-4 col-form-label text-md-right">
                          {{ __('Tipo de Sistema:') }}
                            </label>
                              @if($equipo->TipoSistema != NULL)
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$equipo->TipoSistema}}} BITS"  readonly="readonly" />
                             </div>
                             @endif
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="MemoriaRam" class="col-md-4 col-form-label text-md-right">
                          {{ __('MemoriaRam:') }}
                            </label>
                             
                              <div class="col-md-6">
                                @if($equipo->MemoriaRam != NULL)
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$equipo->MemoriaRam}}} GB"  readonly="readonly" />
                                @endif
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Capacidad" class="col-md-4 col-form-label text-md-right">
                          {{ __('Capacidad:') }}
                            </label>

                              <div class="col-md-6">
                                 @if($equipo->Capacidad != NULL)
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$equipo->Capacidad}}} GB"  readonly="readonly" />
                                 @endif
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Procesador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Procesador:') }}
                            </label>

                              <div class="col-md-6">
                                @if($equipo->Procesador != NULL)
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$equipo->Procesador}}} "  readonly="readonly" />
                                @endif
                             </div>
                    </div>
                    <hr>

                    <br><center><a href="{{ url()->previous() }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center><br>
          </div>
        </div>
     </section>

 
 
@endsection