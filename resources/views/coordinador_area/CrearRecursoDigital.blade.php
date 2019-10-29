@extends('layouts.app')
   
<title>subir_recurso</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@section('content')

<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SUBIR RECURSO DIGITAL</li>
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
                1.-Los campos con asterisco son obligatorios. <br>
                2.-Para subir un recurso digital seleccione en "Subir Archivo".<br> Extensiones admitidas [.pdf, .docx, .doc, .xlsx, .avi, .mp4, .mp3, .mov, .wmv, .xlsm, .html, .onetoc2, .pptx, .pptm]. <br>
                3.-Para subir un Icono seleccione en "Subir Icono", en caso contrario seleccione un icono del sistema.<br>
                4.-En caso de no seleccionar ningun Icono, se asignara el "Icono" por defecto. <br>
                5.-El campo Descripción debe tener un maximo de  100 caracteres.<br>
                6.-Si desea repetir el paso 3, recargue la pagina nuevamente y siga  los pasos  anteriormente mencionados. <br> 
                7.-El tamaño maximo de los archivos admitidos son de : 100MB. <br>
                8.-Asigne un recurso digital a una instalación o laboratorio (opción multiple). <br>
                9.-Finalmente seleccione en Agregar Recurso para guardar cambios. <br>
                </span>
                <br> <br>
               <strong style="color: red;">Campos obligatorios *</strong>

                <form method="post" action="{{ route('recurso.store') }}" enctype="multipart/form-data">
                    @csrf
                   
                     <div class="form-group row">
                            <label for="Categoria" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Categoria:') }}
                                 <strong style="color: red;">*</strong>
                                 
                            </label>

                              <div class="col-md-6">
                                  <select name="Categoria" class="form-control" >
                                      <option value="">Elige una categoria</option>
                                       @foreach ($categoria as $categorias)
                                          <option value="{{{$categorias->idTipoRecurso}}}">{{{$categorias->Categoria}}}</option>
                                       @endforeach
                                 </select>
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Recurso" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Recurso Digital:') }}
                                   <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                    <!--<input type="file" name="RecursoDigital" > -->
                                  <span style="background: #003b5c; color: #00b5e2;" id="ActualizarArchivo">Ningun Archivo Seleccionado.!</span> <br><br>

                                  <label for="FileArchivo" class="subir" id="a">
                                      <i class="fas fa-cloud-upload-alt"></i>Subir Archivo
                                  </label>
                                 <input id="FileArchivo" name="RecursoDigital"  type="file" style='display: none;'/>
                             </div>
                     </div>
                     <hr>
                      <div class="form-group row">
                            <label for="Imagen" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Icono:') }}
                                   
                            </label>

                              <div class="col-md-6">

                                <img src="{{ asset('Almacenamiento/Iconos/recurso.png') }}"  height="100px;" width="80px;"
                                 style="border-color:#00b5e2; border-style: solid;" id="ActualizarImagen"><br><br>
                                 

                                 <label for="FileIcono" class="subir" id="b">
                                      <i class="fas fa-cloud-upload-alt"></i>Subir Imagen
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
                     <div class="form-group row">
                            <label for="Descripción" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Descripción:') }}
                                 
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="DescripcionRecurso" style="height: 150px;"></textarea>
                             </div>
                      </div>
                      <hr>
                         <div class="form-group row">
                            <label for="Descripción" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Instalaciones:') }}
                                    <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                    @foreach ($instalacion as $instalaciones)
                                         <input type="checkbox" name ="Instalaciones[]" value="{{{$instalaciones->idInstalacion}}}" 
                                         style="width: 30px; height: 20px;"> {{{$instalaciones->Nomenclatura}}} <br>
                                    @endforeach
                             </div>
                      </div>

                    <hr>
                      <center><button type="submit" class="boton_EE btn btn-primary">Agregar Recurso</button></center>
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