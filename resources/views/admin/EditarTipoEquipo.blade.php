@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>editar_categoria_equipo</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">EDITAR CATEGORIA DE EQUIPO</li>
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
                     2.-Seleccione en "Actualizar Categoria" para guardar cambios.<br>  
                </span> <br> <br>

                <form method="post" action="{{ route('tipo_equipo.update', $TipoEquipo->idTipo ) }}" style="color:  #003b5c;" >
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                            <label for="Categoria" class="col-md-4 col-form-label text-md-right">
                          {{ __('Categoria:') }}
                           <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Categoria" value="{{{$TipoEquipo->Categoria}}}">
                             </div>
                    </div>

                    <center><button type="submit" class="boton_EE btn btn-primary">Actualizar Categoria</button></center>
          
                 </form>
                   <br><a href="{{ route('tipo_equipo.administrador') }}">
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