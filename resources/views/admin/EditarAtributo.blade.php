@extends('layouts.app') <!-- Herencia de plantilla blade -->
  
<title>Editar_Atributo</title>

<!-- Librerias js-->
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@section('content')

<style>
  #target{
    display: none;
  }
</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Atributo</li>
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

               <span style=" background: #003b5c; color: #00b5e2;">Nota:
                Visualize las Competencias en el apartado "Descripción Lista",posteriormente eliga la opción de Competencia.
                </span><br><br>
               <strong style="color: red;">Campos obligatorios *</strong>
                <form method="post" action="{{ route('atributo.update', $atributo->NumeroAtributo)}}">
                    @method('PATCH')
                    @csrf
                      <div class="form-group row">
                            <label for="NumeroAtributo" class="col-md-4 col-form-label text-md-right">
                                 {{ __('NumeroAtributo:') }}
                                   <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NumeroAtributo" value="{{{ $atributo->NumeroAtributo}}}">
                             </div>
                    </div>
                     <div class="form-group row">
                            <label for="DescripcionAtributo" class="col-md-4 col-form-label text-md-right">
                                 {{ __('DescripcionAtributo:') }}
                                   <strong style="color: red;">*</strong> 
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="DescripcionAtributo" style="height: 150px;">{{{$atributo->DescripcionAtributo}}}</textarea>
                             </div>
                    </div>
                     <div class="form-group row">
                            <label for="DescripciónLista" class="col-md-4 col-form-label text-md-right">
                                 {{ __('DescripciónLista:') }}
                            </label>
                     
                            <div class="col-md-6"> 
                                 <span style="color: #00b5e2;" id="Seleccion" class="form-control"> {{ __('Competencias -- Seleccione Aqui --') }} </span>
                                 
                                 <div id="target">
                                     <hr />
                                     @foreach ($descripcion as $descripcions)
                                       <span >
                                        <b style="background:#003b5c; color: #00b5e2; ">[{{{$descripcions->NumeroCompetencia}}}]</b>
                                          {{{$descripcions->DescripcionCompetencia}}}
                                       </span>
                                       <hr />
                                    @endforeach
                                </div>
                          </div>
                     </div>

                       <div class="form-group row">
                            <label for="Competencia" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Competencia:') }}
                                 <strong style="color: red;">*</strong> 
                            </label>
                             <div class="col-md-6"> 
                              <select name="Competencia" class="form-control">
                                      <option>{{{$descripcionActual->NumeroCompetencia}}}</option>
                                         @foreach ($descripcion as $descripcions)
                                            @if($descripcions->NumeroCompetencia != $descripcionActual->NumeroCompetencia)
                                                 <option>{{{$descripcions->NumeroCompetencia}}}</option>
                                           @endif
                                         @endforeach
                             </select>
                            </div>  

                     </div>
                   <center><button type="submit" class="boton_EE">Actualizar</button></center>
                  
                   <a href="{{{url()->previous()}}}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
                 </form>
            </div>
          </div>
        </div>
     </section>
      
      <script type="text/javascript">
               $(document).ready(function() {
                      $("#Seleccion").click(function () {  
                          $('#target').toggle("slow");
                      });
              });
      </script>
 
 
@endsection