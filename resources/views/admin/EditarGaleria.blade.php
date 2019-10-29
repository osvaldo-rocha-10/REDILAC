@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>Editar_Procesador</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">EditarProcesador</li>
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
                <form method="post" action="{{ route('procesador.update', $procesador->idProcesador ) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                            <label for="Procesador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Procesador:') }}
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Procesador" value="{{{$procesador->Procesador}}}">
                             </div>
                    </div>

                   <center><button type="submit" class="boton_EE">Actualizar</button></center>
                  
                   <a href="{{ URL::to('procesador') }}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
                 </form>
            </div>
          </div>
        </div>
     </section>

 
@endsection