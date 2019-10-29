@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>editar_coordinador</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">EDITAR COORDINADOR</li>
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
                     2.-Seleccione en "Editar Coordinador" para guardar cambios.<br>  
                </span> <br> <br>
                 <form method="post" action="{{ route('usuario.update', $usuario->idCoordinador ) }}" style="color:  #003b5c;">
                    @method('PATCH')
                    @csrf
                     <div class="form-group row">
                            <label for="idCoordinador" class="col-md-4 col-form-label text-md-right">
                          {{ __('(Identificador) idCoordinador:') }}
                            <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="idCoordinador" value="{{{$usuario->idCoordinador}}}">
                             </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="Coordinador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Coordinador:') }}
                            <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Coordinador"  value="{{{$usuario->Nombre}}}">
                             </div>
                    </div>
                    <hr>
                       <div class="form-group row">
                            <label for="TipoCoordinador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Tipo de Coordinador:') }}
                            
                            </label>
                            <div class="col-md-6">

                                <select name="TipoCoordinador" class="form-control">
                                      @if($usuario->TipoUsuario==1)
                                         <option value="{{{$usuario->TipoUsuario}}}">ADMINISTRADOR </option>
                                         <option value="2">ÁREA</option>
                                         <option value="3">DOCENTE</option>
                                      @elseif($usuario->TipoUsuario==2)
                                         <option value="{{{$usuario->TipoUsuario}}}">ÁREA</option>
                                         <option value="1">ADMINISTRADOR</option>
                                         <option value="3">DOCENTE</option>
                                      @else
                                         <option value="{{{$usuario->TipoUsuario}}}">DOCENTE</option>
                                         <option value="1">ADMINISTRADOR</option>
                                         <option value="2">ÁREA</option>
                                      @endif
                                </select>
                              </div>
                     </div>

                   <hr>
              
                   <center><button type="submit" class="boton_EE btn btn-primary">Editar Coordinador</button></center>
                
                </form>
                   <br><a href="{{ route('usuario.administrador_5.1') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
                    <br>
            </div>
          </div>
        </div>
     </section>


 
@endsection