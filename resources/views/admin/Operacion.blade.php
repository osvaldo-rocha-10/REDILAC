@extends('layouts.app') <!-- Herencia de plantilla blade -->
   
<title>operaciones</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SECCIÓN OPERACIONES</li>
          </ul>
        </div>
     </div>
       <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

        </div>
      <section class="statistics">
        <div class="container-fluid">
            <center><h6 class="m-0 font-weight-bold text-primary"> 6 OPERACIONES </h6> </center> <br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-4" style="border-right-style: solid; border-color: #003B5C ;" >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       6.1.- Nueva Dirrección/Academia. <br> <br> 

                              <div class="icon">
                             <center> <i class="fas fa-landmark"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('academia.create') }}"> SELECCIONE AQUI <br>(D/A)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;" >

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                         6.2.- Nueva Instalación. <br> <br> 

                              <div class="icon">
                             <center> <i class="fas fa-building"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('instalacion.create') }}"> SELECCIONE AQUI <br>(INSTALACIÓN)</a></center>
                     </h6>
                 </div>
              </div>
            </div>

             <div class="col-lg-4">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                         6.3.- Nuevo Equipo. <br> <br> 

                              <div class="icon">
                             <center>  <i class="fas fa-database"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('equipo.create') }}"> SELECCIONE AQUI <br>(EQUIPO)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;">
              <!-- Income-->
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                      <h6 class="m-0 font-weight-bold text-primary">  
                         6.4.- Nueva Marca. <br> <br> 

                              <div class="icon">
                             <center>  <i class="fab fa-mastodon"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('marca.create') }}"> SELECCIONE AQUI <br>(MARCA)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4"  style="border-right-style: solid; border-color: #003B5C ;">
              <!-- Income-->
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                      <h6 class="m-0 font-weight-bold text-primary">  
                         6.5.- Nueva Categoria de Instalación. <br> <br> 

                              <div class="icon">
                             <center>  <i class="fas fa-building">/</i><i class="fas fa-network-wired"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('instalacion_categoria.create') }}"> SELECCIONE AQUI <br>(CATEGORIA INSTALACIÓN)</a></center>
                     </h6>
                 </div>
              </div>
            </div>
            <div class="col-lg-4">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                       <h6 class="m-0 font-weight-bold text-primary">  
                         6.5.- Nueva Categoria de Equipo. <br> <br> 

                              <div class="icon">
                             <center> <i class="fas fa-database">/</i><i class="fas fa-network-wired"></i></center>  
                              </div> <br>

                          <center> <a href="{{ route('tipo_equipo.create') }}"> SELECCIONE AQUI <br>(CATEGORIA INSTALACIÓN)</a></center>
                     </h6>
                 </div>
              </div> 
            </div>
    
          </div>
          <br>
           <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">
              <div class="col-lg-6" style="border-right-style: solid; border-color: #003B5C ;">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                       <center><h6 class="m-0 font-weight-bold text-primary">  
                         6.5.- Nuevo Coordinador. <br> <br> 

                              <div class="icon">
                                  <i class="fas fa-user-plus"></i>
                              </div> <br>

                          <center> <a href="{{ route('usuario.create') }}"> SELECCIONE AQUI <br>(COORDINADOR)</a></center>
                     </h6> </center>
                 </div>
              </div> 
            </div>
            <div class="col-lg-6">

                <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                       <center><h6 class="m-0 font-weight-bold text-primary">  
                         6.5.- Si desea realizar alguna operación de competencia,categoria o atributo. <br> <br> 

                              <div class="icon">
                             <i class="fas fa-traffic-light"></i>
                              </div> <br>

                          <center> <a href="{{ route('competencia.index') }}"> SELECCIONE AQUI <br>(COMPETENCIAS)</a></center>
                     </h6> </center>
                 </div>
              </div> 
            </div>
           </div>
          <br>  
        </div>
      </section>
 
@endsection