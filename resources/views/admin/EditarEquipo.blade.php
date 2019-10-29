@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
  <title>editar_equipo</title>
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
            <li class="breadcrumb-item active">EDITAR EQUIPO</li>
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
                     2.-Seleccione en "Actualizar Equipo" para guardar cambios.<br>  
                </span> <br> <br>
                <form method="post" action="{{ route('equipo.update', $equipo->NoInventario ) }}" style="color:  #003b5c;">
                    @method('PATCH')
                    @csrf
                      <div class="form-group row">
                            <label for="TipoEquipo" class="col-md-4 col-form-label text-md-right">
                          {{ __('TipoEquipo:') }}
                                                      <strong style="color: red;">*</strong>
                            </label>
                              <div class="col-md-6">
                             <select name="TipoEquipo" class="form-control">
                                      <option value="{{{$equipo->idTipo}}}">{{{$equipo->Categoria}}}</option>
                                        @foreach ($TipoEquipo as $tipos)
                                            @if($equipo->Categoria != $tipos->Categoria)
                                                 <option value="{{{$tipos->idTipo}}}">{{{$tipos->Categoria}}}</option>
                                           @endif
                                         @endforeach
                             </select>

                           </div>
                    </div>
                    <hr>
                     <div class="form-group row">
                            <label for="Instalacion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Instalacion:') }}
                                                      <strong style="color: red;">*</strong>
                            </label>
                              <div class="col-md-6">
                             <select name="Instalacion" class="form-control">
                                      <option value="{{{$equipo->Instalaciones_idInstalacion}}}">{{{$equipo->Nomenclatura}}}</option>
                                        @foreach ($Instalacion as $instalaciones)
                                            @if($equipo->Nomenclatura != $instalaciones->Nomenclatura)
                                                 <option value="{{{$instalaciones->idInstalacion}}}">{{{$instalaciones->Nomenclatura}}}</option>
                                           @endif
                                         @endforeach
                             </select>
                              <input type="hidden" class="form-control" name="CA" value="{{{$equipo->CA}}}">
                           </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                            <label for="NoInventario" class="col-md-4 col-form-label text-md-right">
                          {{ __('NoInventario:') }}
                                                      <strong style="color: red;">*</strong>
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NoInventario" value="{{{$equipo->NoInventario}}}">
                             </div>
                    </div>
                    <hr>
                      <div class="form-group row">
                            <label for="Serie" class="col-md-4 col-form-label text-md-right">
                          {{ __('Serie:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Serie" value="{{{$equipo->Serie}}}">
                             </div>
                    </div>
                   <hr>
                   <div class="form-group row">
                            <label for="Modelo" class="col-md-4 col-form-label text-md-right">
                          {{ __('Modelo:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Modelo" value="{{{$equipo->Modelo}}}">
                             </div>
                    </div>
                   <hr>

                   
                  @if($equipo->CA==1)
                   <div class="form-group row">
                            <label for="NomenclaturaBuap" class="col-md-4 col-form-label text-md-right">
                          {{ __('NomenclaturaBuap:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="NomenclaturaBuap" value="{{{$equipo->NomenclaturaBuap}}}">
                             </div>
                    </div>
                   <hr>
                   <div class="form-group row">
                            <label for="idProducto" class="col-md-4 col-form-label text-md-right">
                          {{ __('idProducto:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="idProducto" value="{{{$equipo->idProducto}}}">
                             </div>
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="SistemaOperativo" class="col-md-4 col-form-label text-md-right">
                          {{ __('SistemaOperativo:') }}
                            </label>
                             <div class="col-md-6">
                             <select name="SistemaOperativo" class="form-control">
                                  @if($equipo->SistemaOperativo != NULL)
                                   <option>{{{$equipo->SistemaOperativo}}}</option>
                                   @if($equipo->SistemaOperativo == "Windows-10")
                                     <option value="Windows-8">Windows-8</option>
                                     <option value="Windows-7">Windows-7</option>
                                     <option value="Linux-Ubuntu">Linux-Ubuntu</option>
                                     <option value="MacOs">MacOs</option>
                                   @elseif($equipo->SistemaOperativo == "Windows-8")
                                     <option value="Windows-10">Windows-10</option>
                                     <option value="Windows-7">Windows-7</option>
                                     <option value="Linux-Ubuntu">Linux-Ubuntu</option>
                                     <option value="MacOs">MacOs</option>
                                   @elseif($equipo->SistemaOperativo == "Windows-7")
                                     <option value="Windows-10">Windows-10</option>
                                     <option value="Windows-8">Windows-8</option>
                                     <option value="Linux-Ubuntu">Linux-Ubuntu</option>
                                     <option value="MacOs">MacOs</option>
                                    @elseif($equipo->SistemaOperativo == "MacOs") 
                                     <option value="Windows-10">Windows-10</option>
                                     <option value="Windows-8">Windows-8</option>
                                     <option value="Windows-7">Windows-7</option>
                                     <option value="Linux-Ubuntu">Linux-Ubuntu</option>
                                  @else
                                     <option value="Windows-10">Windows-10</option>
                                     <option value="Windows-8">Windows-8</option>
                                     <option value="Windows-7">Windows-7</option>
                                     <option value="MacOs">MacOs</option>
                                  @endif
                                @else
                                    <option value="">Elige sistema operativo</option>
                                    <option value="Windows-10">Windows-10</option>
                                    <option value="Windows-8">Windows-8</option>
                                    <option value="Windows-7">Windows-7</option>
                                    <option value="MacOs">MacOs</option>
                                    <option value="Linux-Ubuntu">Linux-Ubuntu</option>

                                @endif
                             </select>
                           </div>
                    </div>
                    <hr>
                   <div class="form-group row">
                            <label for="TipoSistema" class="col-md-4 col-form-label text-md-right">
                          {{ __('TipoSistema:') }}
                           </label>
                            @if($equipo->TipoSistema == 32)
                             <div class="col-md-2">
                                32 bits <input type="radio"  name="TipoSistema" value="32" checked>
                             </div>
                             <div class="col-md-2">
                                64 bits <input type="radio"  name="TipoSistema" value="64">
                             </div>

                          @else
                              <div class="col-md-2">
                                32 bits <input type="radio"  name="TipoSistema" value="32" >
                             </div>
                             <div class="col-md-2">
                                64 bits <input type="radio"  name="TipoSistema" value="64" checked>
                             </div>
                          @endif
                    </div>
                   <hr>
                   <div class="form-group row">
                            <label for="MemoriaRam" class="col-md-4 col-form-label text-md-right">
                          {{ __('MemoriaRam:') }}
                          
                            </label>
                             <div class="col-md-6">
                             <select name="MemoriaRam" class="form-control">
                                  @if($equipo->MemoriaRam != NULL)
                                   <option value="{{{$equipo->MemoriaRam}}}">{{{$equipo->MemoriaRam}}} GB</option>
                                     @if($equipo->MemoriaRam == 2)
                                     <option value="4">4 GB</option>
                                     <option value="8">8 GB</option>
                                     <option value="16">16 GB</option>
                                     <option value="32">32 GB</option>
                                    @elseif($equipo->MemoriaRam == 4)
                                     <option value="2">2 GB</option>
                                     <option value="8">8 GB</option>
                                     <option value="16">16 GB</option>
                                     <option value="32">32 GB</option>
                                    @elseif($equipo->MemoriaRam == 8)
                                     <option value="2">2 GB</option>
                                     <option value="4">4 GB</option>
                                     <option value="16">16 GB</option>
                                     <option value="32">32 GB</option>
                                    @elseif($equipo->MemoriaRam == 16)
                                     <option value="2">2 GB</option>
                                     <option value="4">4 GB</option>
                                     <option value="8">8 GB</option>
                                     <option value="32">32 GB</option>
                                    @elseif($equipo->MemoriaRam == 32)
                                     <option value="2">2 GB</option>
                                     <option value="4">4 GB</option>
                                     <option value="8">8 GB</option>
                                     <option value="16">16 GB</option>
                                    @endif
                                   @else
                                    <option value="">Eliga tamaño en GB</option>
                                    <option value="2">2 GB</option>
                                    <option value="4">4 GB</option>
                                    <option value="8">8 GB</option>
                                    <option value="16">16 GB</option>
                                    <option value="32">32 GB</option>
                                   @endif
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
                                  @if($equipo->Capacidad != NULL)
                                    <option value="{{{$equipo->Capacidad}}}">{{{$equipo->Capacidad}}} GB</option>
                                     @if($equipo->Capacidad == 250)
                                         <option value="500">500 GB</option>
                                         <option value="1">1 TB</option>
                                     @elseif($equipo->Capacidad == 500)
                                          <option value="250">250 GB</option>
                                          <option value="1">1 TB</option>
                                     @else
                                           <option value="250">250 GB</option>
                                           <option value="500">500 GB</option>
                                     @endif
                                  @else
                                   <option value="">Elige capacidad en disco</option>
                                    <option value="250">250 GB</option>
                                    <option value="500">500 GB</option>
                                    <option value="1">1 TB</option>
                                  @endif
                             </select>
                           </div>
                    </div>
                      <hr>
                      <div class="form-group row">
                            <label for="Procesador" class="col-md-4 col-form-label text-md-right">
                          {{ __('Procesador:') }}
                         
                            </label>
      
                              <div class="col-md-6">
                                 <input type="text" class="form-control" name="Procesador" value="{{{$equipo->Procesador}}}">
                             </div>
                    </div>
                   <hr>
                   @endif
                   <!--- -->
                   <div class="form-group row">
                            <label for="Marca" class="col-md-4 col-form-label text-md-right">
                          {{ __('Marca:') }}
                             
                            </label>
                              <div class="col-md-6">
                              @if($equipo->idMarca != NULL)
                             <select name="Marca" class="form-control">
                                       <option value="{{{$equipo->idMarca}}}">{{{$equipo->Marca}}}</option>
                                        @foreach ($Marca as $marcas)
                                            @if($equipo->Marca != $marcas->Marca)
                                                 <option value="{{{$marcas->idMarca}}}">{{{$marcas->Marca}}}</option>
                                           @endif
                                         @endforeach
                             </select>
                             @else
                                   <select name="Marca" class="form-control">
                                      <option value="">Eliga marca</option>
                                       @foreach ($Marca as $marcas)
                                          <option value="{{{$marcas->idMarca}}}">{{{$marcas->Marca}}}</option>
                                       @endforeach
                             </select>
                             @endif
                           </div>
                    </div>
                   <hr>
                   <div class="form-group row">
                            <label for="TipoAdquisicion" class="col-md-4 col-form-label text-md-right">
                          {{ __('Tipo de Adquisición:') }}
                           
                            </label>
                             <div class="col-md-6">
                             <select name="TipoAdquisicion" class="form-control">
                                  @if($equipo->TipoAdquisicion != NULL)
                                     <option value="{{{$equipo->TipoAdquisicion}}}">{{{$equipo->TipoAdquisicion}}}</option>
                                     @if($equipo->TipoAdquisicion == "RENTADA/O")
                                         <option value="COMPRADA/O-PLANTEL">COMPRADA/O-PLANTEL</option>
                                         <option value="DEPENDENCIA-ADMINISTRATIVA">DEPENDENCIA-ADMINISTRATIVA</option>
                                         <option value="DONADA/O">DONADA/O</option>
                                     @elseif($equipo->TipoAdquisicion == "COMPRADA/O-PLANTEL")
                                         <option value="RENTADA/O">RENTADA/O</option>
                                         <option value="DEPENDENCIA-ADMINISTRATIVA">DEPENDENCIA-ADMINISTRATIVA</option>
                                         <option value="DONADA/O">DONADA/O</option>
                                     @elseif($equipo->TipoAdquisicion == "DEPENDENCIA-ADMINISTRATIVA")
                                         <option value="RENTADA/O">RENTADA/O</option>
                                         <option value="COMPRADA/O-PLANTEL">COMPRADA/O-PLANTEL</option>
                                         <option value="DONADA/O">DONADA/O</option>
                                     @else
                                        <option value="RENTADA/O">RENTADA/O</option>
                                        <option value="COMPRADA/O-PLANTEL">COMPRADA/O-PLANTEL</option>
                                        <option value="DEPENDENCIA-ADMINISTRATIVA">DEPENDENCIA-ADMINISTRATIVA</option>
                                     @endif
                                  @else 
                                    <option value="">Eliga tipo de adquisición</option>
                                    <option value="RENTADA/O">RENTADA/O</option>
                                    <option value="COMPRADA/O-PLANTEL">COMPRADA/O-PLANTEL</option>
                                    <option value="DEPENDENCIA/O-ADMINISTRATIVA">DEPENDENCIA/O-ADMINISTRATIVA</option>
                                    <option value="DONADA/O">DONADA/O</option>
                                 @endif
                             </select>
                           </div>
                    </div>
                   <hr>
                    <div class="form-group row">
                            <label for="Observacion1" class="col-md-4 col-form-label text-md-right">
                                 {{ __('Observacion1:') }}
                                 
                            </label>

                              <div class="col-md-6">
                                 <textarea rows='1' class="form-control" name="Observacion1" style="height: 150px;">{{{$equipo->Observacion1}}}</textarea>
                             </div>
                    </div>
                    <hr>
                     <center><button type="submit" class="boton_EE btn btn-primary">Actualizar Equipo</button></center>
                 </form>
                 <br>
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