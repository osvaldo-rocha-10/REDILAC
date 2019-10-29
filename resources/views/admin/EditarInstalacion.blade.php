@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>editar_instalación</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">EDITAR INSTALACIÓN</li>
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
                3.-Seleccione en "Actualizar Instalación" para guardar cambios. <br>
                </span>
                <br> <br>
                <form method="post" action="{{ route('instalacion.update', $instalacion->idInstalacion)}}" style="color:  #003b5c;">
                    @method('PATCH')
                    @csrf
                      <div class="form-group row">
                            <label for="TipoInstalacion" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Tipo-Instalacion:') }} 
                            </label>
                             <div class="col-md-6"> 
                                   <select name="TipoInstalacion" class="form-control">
                                      <option value="{{{$instalacion->idTipo}}}"> {{{$instalacion->Categoria}}} </option>
                                         @foreach ($categoria as $categorias)
                                            @if($instalacion->Categoria != $categorias->Categoria)
                                                 <option value="{{{$categorias->idTipo}}}"> {{{$categorias->Categoria}}} </option>
                                           @endif
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
                                 <input type="text" class="form-control" name="Nomenclatura" value= "{{{$instalacion->Nomenclatura}}}">
                             </div>
                    </div>
                   <hr>
                     <div class="form-group row">
                            <label for="NoEdificio" class="col-md-4 col-form-label text-md-right">
                          {{ __('NoEdificio:') }}
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NoEdificio" value= "{{{$instalacion->NoEdificio}}}">
                             </div>
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="Ubicacion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Ubicacion:') }}
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Ubicacion" value= "{{{$instalacion->Ubicacion}}}">
                             </div>
                    </div>
                   <hr>
                     <div class="form-group row">
                            <label for="academia" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Dirección/Academia:') }} 
                            </label>
                             <div class="col-md-6"> 
                                   <select name="Dirección/Academia" class="form-control">
                                      <option value="{{{$instalacion->idAcademia}}}">{{{$instalacion->Academia}}}</option>
                                         @foreach ($academia as $academias)
                                            @if($instalacion->Academia != $academias->Academia)
                                                 <option value="{{{$academias->idAcademia}}}">{{{$academias->Academia}}}</option>
                                           @endif
                                         @endforeach
                             </select>
                            </div>  
                    </div>
                         <hr>
                   <center><button type="submit" class="boton_EE btn btn-primary">Actualizar Instalación</button></center>
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