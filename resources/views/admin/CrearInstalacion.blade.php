@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>crear_instalación</title>
@section('content') <!-- Sección inicial blade -->
<style type="text/css">

</style>

 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">CREAR INSTALACIÓN</li>
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
        <!-- Instrucciones  -->
              <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
                1.-Los campos con * son obligatorios. <br>
                2.-El campo Nomenclatura debera tener un  minimo de 2 y maximo de  50 caracteres.<br>
                3.-Los campos No.Edificio y Ubicación  deberan tener un maximo de 50 caracteres.<br>
                4.-Seleccione en "Agregar Instalación" para guardar cambios. <br>
               </span><br><br>
               <strong style="color: red;">Campos obligatorios *</strong>
                <form method="post" action="{{ route('instalacion.store') }}" style="color:  #003b5c;">
                 <!-- Formulario -->
                    @csrf   <!-- Token de seguridad  -->
                      <div class="form-group row">
                            <label for="TipoInstalacion" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Tipo de (Instalación:)') }}
                                 <strong style="color: red;">*</strong> 
                            </label>
                             <div class="col-md-6"> 
                              <select name="TipoInstalacion" class="form-control">
                                      <option value="">-- Eliga Tipo-Instalación --</option>
                                       @foreach ($categoria as $categorias)
                                          <option value="{{{$categorias->idTipo}}}">{{{$categorias->Categoria}}}</option>
                                       @endforeach
                             </select>
                            </div>  
                         </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Nomenclatura" class="col-md-4 col-form-label text-md-right">
                          {{ __('Nomenclatura:') }}
                           <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Nomenclatura">
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="NoEdificio" class="col-md-4 col-form-label text-md-right">
                          {{ __('NoEdificio:') }}
                            
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NoEdificio">
                             </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="Ubicacion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Ubicación:') }}
                            
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Ubicacion">
                             </div>
                    </div>
                    <hr>
                         <div class="form-group row">
                            <label for="academia" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Dirección/Academia:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>
                             <div class="col-md-6"> 
                              <select name="Direccion/Academia" class="form-control">
                                      <option value="">-- Eliga-Academia --</option>
                                       @foreach ($academia as $academias)
                                          <option value="{{{$academias->idAcademia}}}">{{{$academias->Academia}}}</option>
                                       @endforeach
                             </select>
                            </div>  
                         </div>
                         <hr>


                   <center><button type="submit" class="boton_EE  btn btn-primary">Agregar Instalación</button></center>
                
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

 
@endsection