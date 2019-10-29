@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>crear_competencia</title>
@section('content') <!-- Sección inicial blade -->
<style type="text/css">

</style>

 <!-- div parte superior izquierda -->
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">CREAR COMPETENCIA</li>
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
                2.-El campo Numero de competencia debe ser de tipo numerico o con un decimal despues del punto. <br>
                3.-El campo Competencia debe tener un maximo de 500 caracteres. <br>
                4.-Seleccione en Agregar Competencia para guardar cambios.<br> 
                </span>
                <br> <br>
               <strong style="color: red;">Campos obligatorios*</strong>

                <!-- Formulario  -->
                <form method="post" action="{{ route('competencia.store') }}">
                    @csrf
                    <div class="form-group row">
                            <label for="Numero de competencia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Numero de competencia:') }}
                             <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NumeroCompetencia">
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Competencia" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Competencia:') }}
                                  <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="Competencia" style="height: 150px;"></textarea>
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Categoria" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Categoria:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <select name="Categoria" class="form-control">
                                      <option value="">Elige una categoria</option>
                                       @foreach ($categoria as $categorias)
                                          <option value="{{{$categorias->idCompetencia}}}">{{{$categorias->TipoCompetencia}}}</option>
                                       @endforeach
                                 </select>
                              </div>
                     </div>
                     <hr>
                       <div class="form-group row">
                            <label for="Disciplina" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Disciplina:') }}
                                  <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                  <select name="Disciplina" class="form-control">
                                      <option value="">Elige una disciplina</option>
                                      <option value="MATEMATICAS">Matemáticas</option>
                                      <option value="CIENCIAS EXPERIMENTALES">Ciencias Experimentales</option>
                                      <option value="CIENCIAS SOCIALES">Ciencias Sociales</option>
                                      <option value="COMUNICACIÓN">Comunicación</option>
                                      <option value="SN-DISCIPLINA">SN-disciplina</option>
                                 </select>
                             </div>
                    </div>
                    <hr>
                     <center><button type="submit" class="boton_EE btn btn-primary">Agregar Competencia</button></center>
                 
                 </form>
                   <a href="{{{route('competencia.index')}}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
            </div>
          </div>
        </div>
     </section>

 
@endsection