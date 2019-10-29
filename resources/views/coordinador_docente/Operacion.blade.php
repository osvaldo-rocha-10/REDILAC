@extends('layouts.app')
   
<title>operacion_docente</title>
@section('content')
<style type="text/css">

</style>
<div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.docente') }}">Inicio</a></li>
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
            <center><h6 class="m-0 font-weight-bold text-primary"> 4 OPERACIONES </h6> </center> <br>
            <div class="row d-flex" style="border-style: solid; border-color: #003B5C ;">

            <div class="col-lg-12" style="border-right-style: solid; border-color: #003B5C ;" >
             <div class="card income text-center">
                  <div class="card-header" style="text-align: justify;">
                     <h6 class="m-0 font-weight-bold text-primary">  
                       4.1.- Si desea cambiar su imagen. <br> <br> 

                              <div class="icon">
                             <center> <i class="fas fa-user-plus"></i></center>  
                              </div> <br>

                          <center> <a href=""> SELECCIONE AQUI <br>(CAMBIAR IMAGEN)</a></center>
                     </h6>
                 </div>
              </div>
            </div>

          </div>
         <br>
        </div>
      </section>
 
@endsection