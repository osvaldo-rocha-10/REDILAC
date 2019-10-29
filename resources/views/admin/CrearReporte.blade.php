@extends('layouts.app') <!-- Herencia de plantilla blade -->

   <!-- Librerias js -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   
  <title>crear_reporte</title>
@section('content') <!-- Sección inicial blade -->
<style type="text/css">

</style>

 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">INICIO</a></li>
            <li class="breadcrumb-item active">CREAR REPORTE</li>
          </ul>
        </div>
     </div>
     
        <section>
         <div class="container-fluid">
          <br>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>

         <!-- div mensaje con los errores al realizar una operación desde controlador  -->
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
                 1.-Seleccione el tipo de reporte. <br>
                 2.-Anexe información en los campos siguientes reporte/usuario directo/responsable esto es de manera opcional.<br>
                 3.-Para guardar un reporte del sistema seleccione en el link "GUARDAR REPORTE" en la parte inferior del REPORTE-GENERADO.<br>

                </span>
                <br> <br>
               <strong style="color: red;">Campos obligatorios *</strong>
               <!-- Formulario  -->
                <form method="post" action="{{ route('reporte.GenerarReporte') }}">
                    @csrf <!-- Token de seguridad  -->
                     <div class="form-group row" >
                            <label for="TipoReporte" class="col-md-4 col-form-label text-md-right">
                          {{ __('TipoReporte:') }}
                          <strong style="color: red;">*</strong> 
                            </label>
                             <div class="col-md-6">
                             <select name="TipoReporte" id="TipoReporte" class="form-control">
                                    <option value="">Elige una opción</option>
                                    <option value="1">Relación de equipos de computo</option>
                                    <option value="2">Resguardo de Bienes por Usuario</option>
                                    <option value="3">Cambios y modificaciones de equipos de computo</option>
                             </select>
                           </div>
                    </div>
                    <div class="form-group row" id="Fecha" style="display: none;">
                            <label for="Docente" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Fecha:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>
                            
                    </div>
                    <div class="form-group row" id="Equipos" style="display: none;" >
                            <label for="Equipos" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Equipos:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>

                             <div class="col-md-6"> 
                                <h6>Ingrese el/los equipos por su NumeroSerie separados por ',' y a continuación seleccione en el icono  Buscar.</h6>
                                 <input type="text" style="width: 500px;" name="Reporte">
                                 <button type="button" class="boton_EE" style="height: 20px; width: 30px;"><i class="fas fa-search"></i></button>
                            </div>  
                    </div>
                    <div class="form-group row" id="Resguardo" style="display: none;" >
                            <label for="Docente" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Docente:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>
                             <div class="col-md-6"> 
                              <h6>Seleccione un Docente Administrador-Coordinador</h6>
                              <select name="Docente" class="form-control">
                                      <option value="">-- Eliga opción --</option>
                                       @foreach ($usuario as $usuarios)
                                          <option>{{{$usuarios->idUsuario}}} - {{{$usuarios->Nombre}}}</option>
                                       @endforeach
                             </select>
                            </div>  
                    </div>

                    
                   <hr>
                    <div class="form-group row">
                            <label for="Reporte" class="col-md-4 col-form-label text-md-right">
                          {{ __('Reporte:') }}
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Reporte">
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="UsuarioDirecto" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Usuario Directo:') }}
                            </label>
                             <div class="col-md-6"> 
                               <input type="text" class="form-control" name="UsuarioDirecto">
                            </div> 
                    </div>
                    <div class="form-group row">
                            <label for="Responsable" class="col-md-4 col-form-label text-md-right">
                                 {{ __('(Responsable:)') }} 
                            </label>
                             <div class="col-md-6"> 
                               <input type="text" class="form-control" name="Responsable">
                            </div> 
                    </div>
                    <hr>

                   <center><button type="submit" class="boton_EE">Generar-Reporte</button></center>
                 </form>
                  <a href="{{url()->previous()}}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
            </div>
          </div>
        </div>
     </section>

    <!-- script animacion dependiendo usuario -->
     <script type="text/javascript">
           $("#TipoReporte").change(function(){
             var opcion = $('select[id=TipoReporte]').val();
             if(opcion!=''){
                  if(opcion==1 || opcion==2){
                      $('#Resguardo').hide();
                      $('#Equipos').hide();
                      $('#Fecha').hide();
                  }else if(opcion==3){
                      $('#Resguardo').hide();
                      $('#Equipos').hide();
                      $('#Fecha').show();
                  }else if(opcion==4){
                      $('#Resguardo').hide();
                      $('#Equipos').show();
                      $('#Fecha').hide();
                  }else{
                     $('#Resguardo').show();
                      $('#Equipos').hide();
                      $('#Fecha').hide();
                  }
             }
          }
       );
     </script>

 
@endsection