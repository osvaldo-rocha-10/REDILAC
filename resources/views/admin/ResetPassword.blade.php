@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>reset_password</title>

  <!-- Libreria js-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">RESTABLECER CONTRASEÑA</li>
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
               1.-Los campos con * son obligatorios. <br>
               2.-Seleccione en "Restablecer Contraseña" para guardar cambios.<br>  

                </span> <br><br>
                 <form method="post" action="{{ route('usuario.updatepassword',$id) }}" style="color:  #003b5c;">
                    @method('put')    <!-- Definir el metodo put o {{ method_field('put') }} -->
                    @csrf
                       <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                          {{ __('Contraseña:') }}
                             <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="password" class="form-control contrasena" name="password" id="myInput">
                             </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Contraseña') }}
                            <strong style="color: red;">*</strong> 
                            </label>
                             
                            <div class="col-md-6">
                                <input id="password-confirm " type="password" class="form-control contrasena" name="password_confirmation">
                                   
                            </div>
                            
                    </div>
                     <hr>  
                            <center><input type="checkbox" id="mostrar_contrasena" onclick="myFunction()" style="width: 20px; height: 20px;">  Mostrar Contraseña
                            </center>
                    <hr>
                   <center><button type="submit" class="boton_EE btn btn-primary">Restablecer Contraseña</button></center>
                
                </form>
                   <a href="{{ route('usuario.administrador_5.1') }}">
                        <button type="button" class="boton_EE btn btn-primary">
                          <i class="fas fa-reply"></i> Regresar
                        </button>
                  </a>
            </div>
          </div>
        </div>
     </section>

      
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