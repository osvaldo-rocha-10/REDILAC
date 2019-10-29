@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>crear_usuario</title>

    <!-- Librerias js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@section('content') <!-- Sección inicial blade -->
<style type="text/css">
</style>

<!-- div parte superior izquierda -->

<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">CREAR USUARIO</li>
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
                1.-Los campos con * son obligatorios. <br> 
                2.-El campo Identificador de Coordinador (idCoordinador) debe ser unico, ademas de tener un  maximo de 9 digitos.<br>
                2.-El campo Usuario debe tener un  maximo de 50 caracteres, ademas de estar formado por una combinación de numeros y caracteres.<br>
                3.-El campo Password debe tener un minimo de 3 y  maximo de 50 caracteres, ademas de estar formado por una combinación de numeros y caracteres. <br>
                4.-Seleccione en "Agregar Coordinador" para guardar cambios <br>


                </span>
                <br> <br>
               <strong style="color: red;">Campos obligatorios *</strong>
               <!-- Formulario -->

                <form method="post" action="{{ route('usuario.store') }}" enctype="multipart/form-data" style="color:  #003b5c;">
                  @csrf <!-- Token de seguridad-->


                     <div class="form-group row">
                            <label for="idUsuario" class="col-md-4 col-form-label text-md-right">
                          {{ __('(Identificador) idCoordinador:') }}
                            <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="idCoordinador">
                             </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="Coordinador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Coordinador:') }}
                            <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Coordinador">
                             </div>
                    </div>
                    <hr>
                       <div class="form-group row">
                            <label for="TipoCoordinador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Tipo de  Coordinador:') }}
                             <strong style="color: red;">*</strong>
                            </label>
                              <div class="col-md-6">
                                <select name="TipoCoordinador" class="form-control">
                                      <option value="">-- Eliga un tipo de coordinador --</option>
                                      <option value="1">ADMINISTRADOR</option>
                                      <option value="2">DE ÁREA</option>
                                      <option value="3">DOCENTE</option>
                                       
                                </select>
                              </div>
                         
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="Direcci0n/Academia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Dirección/Academia:') }}
                             <strong style="color: red;">*</strong>
                            </label>
                            <div class="col-md-6">
                             <select name="Direccion/Academia" class="form-control">
                                      <option value="">Elige una opción</option>
                                       @foreach ($academia as $academias)
                                          <option value="{{{$academias->idAcademia}}}">{{{$academias->Academia}}}</option>
                                       @endforeach
                             </select>
                           </div>
                         
                    </div>
                   <hr>
                    <div class="form-group row">
                             <label for="Imagen" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Image:') }}
                                   
                            </label>

                              <div class="col-md-6">

                                <img src="{{ asset('Almacenamiento/Coordinadores/default_user.jpg') }}"  height="100px;" width="100px;"
                                 style="border-color:#00b5e2; border-style: solid;" id="ActualizarImagen"><br><br>
                                 <label for="FileIcono" class="subir" id="b">
                                      <i class="fas fa-cloud-upload-alt"></i>Subir Imagen
                                  </label>
                                 <input id="FileIcono" name="Imagen1"  type="file" accept="image/*" style='display: none;'/>
                             </div>
                     </div>
                    <hr>
                   <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                          {{ __('Contraseña:') }}
                            <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="password" class="form-control contrasena" name="password" >
                             </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}  <strong style="color: red;">*</strong></label>
                             
                            <div class="col-md-6">
                                <input id="password-confirm " type="password" class="form-control contrasena" name="password_confirmation" >
                            </div>
                            
                    </div>
                    <hr>  
                            <center><input id="mostrar_contrasena" type="checkbox"  style="width: 20px; height: 20px;">  Mostrar Contraseña
                            </center>
                    <hr>
                   <center><button type="submit" class="boton_EE btn btn-primary">Agregar Coordinador</button></center>
                </form>
                 <a href="{{url()->previous()}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                 </a>
            </div>
          </div>
        </div>
     </section>

      <!-- Script checked mostrar constraseña  -->

       <script type="text/javascript">
      $(document).ready(function () {
        $('#mostrar_contrasena').click(function () {

          if ($('#mostrar_contrasena').is(':checked')) {
                $('.contrasena').attr('type', 'text');
          } else {
                $('.contrasena').attr('type', 'password');
          }

        });
      });
       </script>

@endsection