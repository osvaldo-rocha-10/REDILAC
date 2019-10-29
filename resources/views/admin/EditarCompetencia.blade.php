@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>editar_competencia</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">EDITAR COMPETENCIA</li>
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
                     2.-Seleccione en Actualizar competencia para guardar cambios.<br>  
                </span> <br> <br>
                <form method="post" action="{{ route('competencia.update', $competencia->NumeroCompetencia ) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                            <label for="NumeroCompetencia" class="col-md-4 col-form-label text-md-right">
                          {{ __('NumeroCompetencia:') }}
                            <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name=" NumeroCompetencia" value="{{{ $competencia->NumeroCompetencia}}}">
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Competencia" class="col-md-4 col-form-label text-md-right">
                          {{ __('Competencia:') }}
                            <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                <textarea rows='1' class="form-control" name="Competencia" style="height: 150px;">{{{$competencia->DescripcionCompetencia}}}</textarea>
                             </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Categoria" class="col-md-4 col-form-label text-md-right">
                          {{ __('Categoria:') }}
                            
                            </label>

                              <div class="col-md-6">
                                  <select name="Categoria" class="form-control">
                                      <option value="{{{$competencia->idCompetencia}}}">{{{$competencia->TipoCompetencia}}}</option>
                                         @foreach ($categoria as $categorias)
                                           @if($categorias->TipoCompetencia != $competencia->TipoCompetencia)
                                                 <option value="{{{$categorias->idCompetencia}}}">{{{$categorias->TipoCompetencia}}}</option>
                                           @endif
                                       @endforeach
                                 </select>

                             </div>
                     </div>
                     <hr>
                     <div class="form-group row">
                            <label for="Disciplina" class="col-md-4 col-form-label text-md-right">
                          {{ __('Disciplina:') }}
                            
                            </label>

                              <div class="col-md-6">
            
                                   <select name="Disciplina" class="form-control">
                                          <option>{{{$competencia->Disciplina}}}</option>
                                       @if($competencia->Disciplina == "SN-DISCIPLINA")
                                          <option value="MATEMATICAS">Matemáticas</option>
                                          <option value="CIENCIAS EXPERIMENTALES">Ciencias Experimentales</option>
                                          <option value="CIENCIAS SOCIALES">Ciencias Sociales</option>
                                          <option value="COMUNICACIÓN">Comunicación</option>
                                       @elseif($competencia->Disciplina == "MATEMATICAS")
                                          <option value="CIENCIAS EXPERIMENTALES">Ciencias Experimentales</option>
                                          <option value="CIENCIAS SOCIALES">Ciencias Sociales</option>
                                          <option value="COMUNICACIÓN">Comunicación</option>
                                          <option value="SN-DISCIPLINA">SN-DISCIPLINA</option>
                                       @elseif($competencia->Disciplina == "CIENCIAS EXPERIMENTALES")
                                          <option value="MATEMATICAS">Matemáticas</option>
                                          <option value="CIENCIAS SOCIALES">Ciencias Sociales</option>
                                          <option value="COMUNICACIÓN">Comunicación</option>
                                          <option value="SN-DISCIPLINA">SN-DISCIPLINA</option>
                                       @elseif($competencia->Disciplina == "CIENCIAS SOCIALES")
                                          <option value="MATEMATICAS">Matemáticas</option>
                                          <option value="CIENCIAS EXPERIMENTALES">Ciencias Experimentales</option>
                                          <option value="COMUNICACIÓN">Comunicación</option>
                                          <option value="SN-DISCIPLINA">SN-DISCIPLINA</option>
                                       @elseif($competencia->Disciplina == "COMUNICACIÓN")
                                          <option value="MATEMATICAS">Matemáticas</option>
                                          <option value="CIENCIAS EXPERIMENTALES">Ciencias Experimentales</option>
                                          <option value="CIENCIAS SOCIALES">Ciencias Sociales</option>
                                          <option value="SN-DISCIPLINA">SN-DISCIPLINA</option>
                                       @endif
                                 </select>
                             </div>
                    </div>

                    <center><button type="submit" class="boton_EE btn btn-primary">Actualizar competencia</button></center>
          
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