@extends('layouts.app')
   
<title>editar_recurso_digital</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section('content')

  <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            <li class="breadcrumb-item active">EDITAR RECURSO DIGITAL</li>
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
               2.-Seleccione en "Actualizar Recurso" para guardar cambios.<br>  
            </span>
            <br> <br>
                  <?php
                        $Nombre= pathinfo($recurso->RecursoDigital, PATHINFO_FILENAME); 
                        $extension = pathinfo($recurso->RecursoDigital, PATHINFO_EXTENSION);
                  ?>
                <form method="post" action="{{ route('recurso.update', $recurso->idRecursoDigital ) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                          {{ __('Descripcion:') }}
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="DescripcionRecurso" style="height: 150px;">{{{$recurso->DescripcionRecurso}}}</textarea>
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                          {{ __('RecursoDigital:') }}
                           <strong style="color: red;">*</strong>
                            </label>
                            
                            <div class="col-md-6">
                               <input type="text" class="form-control" name="RecursoDigital" value="{{{ $Nombre }}}">
                             </div>
                    </div>
                    <div class="form-group row">
                               <label for="name" class="col-md-4 col-form-label text-md-right">
                          {{ __('Extension:') }}
                               </label>

                             <div class="col-md-6">
                               <input type="text"  name="Extension" value="{{{$extension}}}" readonly/  style=" opacity: 0.5; width: 45px;">
                             </div> 
                    </div>   
                    <hr>
                    <div class="form-group row">
                            <label for="Imagen" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Icono:') }}
                            </label>

                              <div class="col-md-6">

                                <img src="{{ asset('Almacenamiento/Iconos/'.$recurso->Imagen) }}"  height="100px;" width="80px;"
                                 style="border-color:#00b5e2; border-style: solid;" id="ActualizarImagen"><br><br>

                                 <input  name="Actual" value="{{{$recurso->idImage}}}" type="text" style='display: none;'>

                                 <label for="FileIcono" class="subir" id="b">
                                      <i class="fas fa-cloud-upload-alt"></i>Cambiar Imagen
                                  </label>

                                 <input id="FileIcono" name="Imagen1"  type="file" accept="image/*" style='display: none;'/>
                                 <br><br> ó  selecciona una imagen.<br><br>

                                 
                                 <select name="Imagen2" class="form-control" id="Imagen2">
                                      <option value="">Elige una opción</option>
                                       @foreach ($icono as $iconos)
                                          <option value="{{{$iconos->idImage}}}">{{{$iconos->Imagen}}}</option>
                                       @endforeach
                                 </select>
                             </div>
                     </div>
                        <hr>
                       <center><button type="submit" class="boton_EE btn btn-primary">Actualizar Recurso</button></center>

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
      <script type="text/javascript">

        $("#Imagen2").change(function(){ 
              var dirr = "{{ asset('Almacenamiento/Iconos') }}"+"/"+$("#Imagen2 option:selected").text();
              $('#ActualizarImagen').attr('src',dirr);
              $("#FileIcono").attr('disabled','disabled');
              $('#b').css('background', '#9C9A99');

         });

      </script>
 
@endsection