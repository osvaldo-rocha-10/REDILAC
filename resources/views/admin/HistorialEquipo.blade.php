@extends('layouts.app') <!-- Herencia de plantilla blade -->
  
<title>informacion_equipo</title>

<!-- Librerias js -->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@section('content')

<style>
  #target{
    display: none;
  }
</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
             @if(Auth::User()->idCoordinador==1)
               <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
             @else
               <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            @endif
            <li class="breadcrumb-item active">InformaciónEquipo</li>
          </ul>
        </div>
     </div>
     
        <section>
         <div class="container-fluid">
          <!-- DataTales Example -->
          <br>
          <div class="card shadow mb-4" style="color:  #003b5c;">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
             <br>
             <center> <span style=" background: #003b5c; color: #00b5e2;">Información Equipo</span></center>
             <br>
             <br>

                    <div class="form-group row">
                            <label for="NoInventario" class="col-md-4 col-form-label text-md-right">
                          {{ __('NoInventario:') }}
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$Historial->Equipos_NoInventario}}}"  readonly="readonly" />
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Estatus:') }}
                            </label>
                             @if($Historial->Estatus==1)
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "Activo"  readonly="readonly" />
                             </div>
                             @else
                             <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "No-Activo" readonly="readonly" / >
                             </div>
                             @endif
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Registro (REDILAC/REDIGLABUAP):') }}
                            </label>
                              @if($Historial->Registro==1)
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "REDILAC"  readonly="readonly" />
                             </div>
                             @else
                               <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "REDIGLABUAP"  readonly="readonly" / >
                             </div>
                             @endif
                    </div>
                    <hr>

                    <div class="form-group row">
                            <label for="Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Alta:') }}
                            </label>
                            
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$Historial->Alta}}}" readonly="readonly" />
                             </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                            <label for="Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Baja:') }}
                            </label>
                            
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$Historial->Baja}}}"  readonly="readonly" / >
                             </div>

                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __(' Ultima modificación :') }}
                            </label>
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$Historial->Edita}}}"  readonly="readonly" />
                             </div>
                    </div>
                    <hr>
                  <br><center><a href="{{url()->previous()}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>
                 <br>
          </div>
        </div>
     </section>
      
      <script type="text/javascript">
               $(document).ready(function() {
                      $("#Seleccion").click(function () {  
                          $('#target').toggle("slow");
                      });
              });
      </script>
 
 
@endsection