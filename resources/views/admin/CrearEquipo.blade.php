@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>crear_equipo</title>
@section('content')  <!-- Sección inicial blade -->

<!-- Librerias js -->
 <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

 <!-- div parte superior izquierda -->
   <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">

            @if(Auth::User()->TipoUsuario==1)
               <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            @else
              <li class="breadcrumb-item"><a href="{{ route('home.area') }}">INICIO</a></li>
            @endif
            <li class="breadcrumb-item active">CREAR EQUIPO</li>

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

             <!-- Instrucciones-->
               <span style=" background: #003b5c; color: #00b5e2;">Instrucciones:<br>
                1.-Proporcione la mayor cantidad de información posible con el fin de tener un mejor control de los equipos registrados.<br>
                2.-Los campos con * son obligatorios <br>
                3.-El campo NoInventario debera tener entre 0 y 9 digitos. <br>
                4.-En caso de contar con los campos "idProducto, Modelo y Serie" , estos deben tener al menos 3 y como  maximo 50 caracteres, ademas de estar formado por una combinación de numeros y caracteres. <br>
                5.-En caso de contar con el campo NomenclaturaBuap debera tener al menos 7 y como maximo 50 caracteres, ademas de estar formado por una combinación de numeros y caracteres. <br>
                6.-El campo Observacion 1 debe tener un maximo de 500 caracteres. <br>
                7.-Seleccione en "Agregar Equipo" para guardar cambios <br>
                </span>
                <br> <br>

               <strong style="color: red;">Campos obligatorios *</strong>
               <!-- Formulario -->
                <form method="post" action="{{ route('equipo.store') }}" style="color:  #003b5c;">
                    @csrf
                      <div class="form-group row">
                            <label for="TipoEquipo" class="col-md-4 col-form-label text-md-right">
                          {{ __('TipoEquipo:') }}
                           <strong style="color: red;">*</strong> 
                            </label>
                              <div class="col-md-6">
                             <select name="TipoEquipo" id="TipoEquipo" class="form-control">
                                      <option value="">Elige un tipo de equipo</option>
                                       @foreach ($TipoEquipo as $equipos)
                                          <option value="{{{$equipos->idTipo}}}" data-id="{{{$equipos->CA}}}">{{{$equipos->Categoria}}}</option>
                                       @endforeach
                             </select>
                           </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                            <label for="Instalacion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Instalación:') }}
                           <strong style="color: red;">*</strong> 
                            </label>
                              <div class="col-md-6">
                             <select name="Instalacion" class="form-control">
                                      <option value="">Elige una instalación</option>
                                       @foreach ($Instalacion  as $instalaciones)
                                          <option value="{{{$instalaciones->idInstalacion}}}">{{{$instalaciones->Nomenclatura}}}</option>
                                       @endforeach
                             </select>
                           </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                            <label for="NoInventario" class="col-md-4 col-form-label text-md-right">
                          {{ __('No.Inventario:') }}
                           <strong style="color: red;">*</strong> 
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NoInventario">
                             </div>
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="Serie" class="col-md-4 col-form-label text-md-right">
                          {{ __('Serie:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Serie">
                             </div>
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="Modelo" class="col-md-4 col-form-label text-md-right">
                          {{ __('Modelo:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Modelo">
                             </div>
                    </div>
                   <hr>
                   <div class="form-group row">
                            <label for="Marca" class="col-md-4 col-form-label text-md-right">
                          {{ __('Marca:') }}
                             
                            </label>
                              <div class="col-md-6">
                             <select name="Marca" class="form-control">
                                      <option value="">Elige una Marca</option>
                                       @foreach ($Marca as $marcas)
                                          <option value="{{{$marcas->idMarca}}}">{{{$marcas->Marca}}}</option>
                                       @endforeach
                             </select>
                           </div>
                    </div>
                    <hr>
                    <!------------------------------------------------------------------------------------------>
                    <div class="oculto">
                        <div class="form-group row">
                            <label for="NomenclaturaBuap" class="col-md-4 col-form-label text-md-right">
                          {{ __('Nomenclatura Buap:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NomenclaturaBuap">
                             </div>
                         </div>
                       <hr>
                         <div class="form-group row">
                            <label for="idProducto" class="col-md-4 col-form-label text-md-right">
                          {{ __('Licencia (idProducto:)') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="idProducto">
                             </div>
                        </div>
                        <hr>
                          <div class="form-group row">
                            <label for="SistemaOperativo" class="col-md-4 col-form-label text-md-right">
                          {{ __('SistemaOperativo:') }}
                            </label>
                             <div class="col-md-6">
                             <select name="SistemaOperativo" class="form-control">
                                   <option value="">Eliga S.0</option>
                                    <option value="Windows-10">Windows-10</option>
                                    <option value="Windows-8">Windows-8</option>
                                    <option value="Windows-7">Windows-7</option>
                                    <option value="MacOs">MacOs</option>
                                    <option value="Linux-Ubuntu">Linux-Ubuntu</option>
                             </select>
                           </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="TipoSistema" class="col-md-4 col-form-label text-md-right">
                          {{ __('TipoSistema:') }}
                         
                            </label>
                             <div class="col-md-2">
                                32 bits <input type="radio"  name="TipoSistema" value="32" checked>
                             </div>
                             <div class="col-md-2">
                                64 bits <input type="radio"  name="TipoSistema" value="64">
                             </div>
                       </div>
                   <hr>
                    <div class="form-group row">
                            <label for="MemoriaRam" class="col-md-4 col-form-label text-md-right">
                          {{ __('MemoriaRam:') }}
                           
                            </label>
                             <div class="col-md-6">
                             <select name="MemoriaRam" class="form-control">
                                   <option value="">Elige Tamaño en GB</option>
                                    <option value="2">2 GB</option>
                                    <option value="4">4 GB</option>
                                    <option value="8">8 GB</option>
                                    <option value="16">16 GB</option>
                                    <option value="32">32 GB</option>
                             </select>
                           </div>
                    </div>
                   <hr>
                     <div class="form-group row">
                            <label for="Capacidad" class="col-md-4 col-form-label text-md-right">
                          {{ __('Capacidad en Disco:') }}
                          
                            </label>
                             <div class="col-md-6">
                             <select name="Capacidad" class="form-control">
                                   <option value="">Eliga Capacidad</option>
                                    <option value="250">250 GB</option>
                                    <option value="500">500 GB</option>
                                    <option value="1">1 TB</option>
                             </select>
                           </div>
                    </div>
                   <hr>
                      <div class="form-group row">
                            <label for="Procesador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Procesador:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Procesador">
                             </div>
                    </div>
                   <hr>
                    </div>
                     <!------------------------------------------------------------------------------------------>
                    <div class="form-group row">
                            <label for="TipoAdquisicion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Tipo de Adquisición:') }}
                          
                            </label>
                             <div class="col-md-6">
                             <select name="TipoAdquisicion" class="form-control">
                                   <option value="">Elige un tipo de adquisición</option>
                                    <option value="RENTADA/O">RENTADA/O</option>
                                    <option value="COMPRADA/O POR EL PLANTEL">COMPRADA/O POR EL PLANTEL</option>
                                    <option value="DEPENDENCIA ADMINISTRATIVA">DEPENDENCIA-ADMINISTRATIVA</option>
                                    <option value="DONADA/O">DONADA/O</option>
                             </select>
                           </div>
                    </div>
                    <hr>
                   <div class="form-group row">
                            <label for="Observacion1" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Observacion1:') }}
                                 
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="Observacion1" style="height: 150px;"></textarea>
                             </div>
                    </div>
                    <hr>
                   <center><button type="submit" class="boton_EE btn btn-primary">Agregar Equipo</button></center>
                
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