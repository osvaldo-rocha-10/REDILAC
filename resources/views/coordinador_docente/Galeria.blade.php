@extends('layouts.app')

       <title>mi_galeria</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

@section('content')

     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
             
            <li class="breadcrumb-item"><a href="{{ route('home.docente') }}">INICIO</a></li>
            <li class="breadcrumb-item active">MI GALERIA DE EQUIPOS</li>
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
        <section>


        @if(session('error'))
          <div class="card-body">
                    <div class="alert alert-danger">
                                  {{ session('error') }}
                   </div>                 
          </div>
        @endif

        @if(session('warning'))
              <div class="card-body">
                    <div class="alert alert-warning">
                                  {{ session('warning') }}
                   </div>                 
             </div>
        @endif


      
      <div class="container-fluid">
      
          <div class="card shadow mb-4">
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
                     <center> SUBIR GALERIA</center>
               <br>
               INSTRUCCIONES : <br><br>
                   &nbsp;&nbsp;  1.- Extensiones admitidas [.jpg, .png, .jpeg, .gif , .raw]. <br> <br>
                   &nbsp;&nbsp;  2.- Dar click en "Elegir archivos" para subir las imagenes. <br><br>
                   &nbsp;&nbsp;  3.- Maximo de imagenes seleccionadas 10. <br><br>

               <form method="post" action="{{route('galeria.subir',$NoInventario)}}"  enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <center>
                        <input id="image" type="file" name="image[]"  multiple="multiple">

                        <br><br>

                        <div class="alert alert-danger" style="width: 50%;">
                        <h6 class="m-0 font-weight-bold" >Si tiene problemas al cargar la imagen/es, recargue la pagina nuevamente.</h6>
                       </div>
                     
                   </center>  
                    
                       &nbsp;&nbsp; 3.-Seleccione aqui 
                          <button type="submit" class="boton_Excel" style="height:25px;" id="subir" disabled/>
                             <i class="fas fa-cloud-upload-alt"></i>
                         </button>
                         para subir las imagenes al sistema.
                         
                      </h6>
               </form>
              
              </h6>
            </div>
            <br>

          <form method="post" action="{{route('galeria.eliminar')}}">
            @csrf

        @if(count($galeria)>0)
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;" >
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">GALERIA</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">
                 <div class="col-lg-12">
                   <h5 class="m-0 font-weight-bold">   

                    Total de imagenes <br>
                      {{{count($galeria)}}}

                     <br> <br>

                    

                   </h5>
                   <h6 class="m-0 font-weight-bold text-primary">  
                    1.-Dar click en las casillas para eliminar o descargar imagenes en su galeria. <br><br>
                    2.-Si desea ampliar la imagen seleccione directamente en cada una de ellas. <br> <br>
                   </h6>
                </div>

               </div>

           @php($i=1)

            <div class="row d-flex" style="border-top:2px solid; border-bottom:2px solid; border-color: #003B5C ;">
         
           @foreach ($galeria as $galerias)
             
             @if($i % 4 != 0)
                 <div class="col-lg-3" style="border-right:2px solid; border-color: #003B5C ;">
             @else
                 <div class="col-lg-3">
             @endif
               
                <input  type="checkbox" name ="galeria[]" value="{{{$galerias->idGaleria}}}" style="width: 30px; height: 20px;">

                    <a href="{{ asset('Almacenamiento/GaleriaEquipos/'.$galerias->Imagen) }}">
                       <img src="{{ asset('Almacenamiento/GaleriaEquipos/'.$galerias->Imagen) }}" alt="person" height="200px;" width="200px;"></a>
              </div>

              @if($i % 4 == 0)
                </div>
                    @php($x = count($galeria)-$i)

                 @if($x != 0 )
                      <div class="row d-flex" style="border-bottom:2px solid; border-color: #003B5C ;">
                 @else
                     <div class="row d-flex">
                 @endif
              @endif


              @php($i=$i+1)
            @endforeach
           

            @if($i % 4 != 0)
              </div>
            @endif

             <br><br>
                <center>   
                   <button type="submit" name="descargar" class="boton_EE btn btn-primary">
                      <i class="fas fa-download"></i> Descargar
                   </button>

                    <button type="submit" name="eliminar" class="boton_EE btn btn-primary" data-toggle="modal">
                      <i class="far fa-trash-alt"></i> Eliminar
                   </button>
               </center>
            
          </form>
            @else
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        SIN EVIDENCIAS DE GALERIA. <br>
                        </div>
                      </center>
              <br>
            @endif
          </div>
          
        </div>
        <br>
         <center><a href="{{ URL::to('/equipo/docente/1.1') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
           </center>
     </section>

@endsection