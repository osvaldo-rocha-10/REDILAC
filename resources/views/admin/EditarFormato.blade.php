@extends('layouts.app') <!-- Herencia de plantilla blade -->
    
  <title>editar_formato</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
             @if(Auth::User()->TipoUsuario==1)
              <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            @else
              <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            @endif
            <li class="breadcrumb-item active">Cambiar Nombre/Formato</li>
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


        @if(session('Error'))
          <div class="card-body">
                        
                           
                             <div class="alert alert-danger">
                                  {{ session('Error') }}
                             </div>
                      
                          
          </div>
         @endif
 
                 <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
                     1.-Los campos con * son obligatorios. <br>
                     2.-El Nombre no debe ser mayor de 50 caracteres. <br>
                     3.-Seleccione en "Editar Nombre" para guardar cambios.<br>  
                </span> <br> <br>

               <form method="post" action="{{ route('formato.update',$idFormato ) }}" style="color:  #003b5c;">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                            <label for="Formato" class="col-md-4 col-form-label text-md-right">
                            {{ __('Formato:') }}
                              <strong style="color: red;">*</strong>
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Formato" value="{{{$Nombre}}}">
                                 <input type="hidden" class="form-control" name="Extension" value="{{{$Extension}}}">
                             </div>
                    </div>

                  <center><button type="submit" class="boton_EE btn btn-primary">Editar Nombre</button></center>
                 </form>

                   <br><a href="{{ URL::to('formato') }}">
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