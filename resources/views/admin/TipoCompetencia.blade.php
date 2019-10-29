@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>categoria_competencia</title>

       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
              <li class="breadcrumb-item active">SUBSECCIÓN CATEGORIA DE COMPETENCIA</li>
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
        
         <div class="container-fluid">
          <div class="card shadow mb-4">
            
             <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <h6 class="m-0 font-weight-bold text-primary">  
               <center> 6.5.2 CATEGORIA DE COMPETENCIAS </center>
              
               <br> <br>
               6.5.2.1- Realice operaciones de editar o eliminar una categoria de competencia en la tabla de "CATEGORIAS DE COMPETENCIAS". <br><br>
               6.5.2.2.-Si desea agregar alguna categoria de competencia seleccione aqui 
                  <a href="{{ route('competencia_categoria.create') }}">
                       <button type="button" class="boton_EE align-items-left" style="height:25px;">
                         <i class="fas fa-traffic-light"></i> -> <i class="fas fa-network-wired"></i>
                     </button>
                    </a> <br>
               <br><br>
              
              </h6>
             </div>
             <br>
            @if(count($categoria)>0)
            <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
              <center>
                <h3 class="m-0 font-weight-bold " style="color: #003b5c;">COMPETENCIAS</h3> <br>
               </center>
               <div class="row d-flex" style="text-align: center; color:#003b5c;">

                <div class="col-lg-12">
                  <h5 class="m-0 font-weight-bold ">  
                   Categorias Registradas  <br> 
                      {{{count($categoria)}}}
                  </h5>
                </div>
      
               </div>
            </div>
         

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>Categoria</th>
                      <th>Objetivo</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                       <th>Categoria</th>
                      <th>Objetivo</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                
                      @foreach ($categoria as $categorias)
                        <tr>
                           <td>{{{$categorias->TipoCompetencia}}}</td>
                           <td>{{{$categorias->Objetivo}}}</td>
                           <td>
                              <a href="{{ route('competencia_categoria.edit',['id' => $categorias->idCompetencia])}}">
                              <button type="button" class="boton_EE"><i class="far fa-edit"></i></button>
                            </a>
                           </td>
                           <td>
                              <form method="post" action="{{ route('competencia_categoria.destroy',$categorias->idCompetencia) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="boton_EE" onclick="return confirm('Desea Eliminar la categoria de competencia: {{{$categorias->TipoCompetencia}}}')"><i class="far fa-trash-alt"></i></button>
                            </form>
                           </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
         @else
                 <br> <br>
                      <center> 
                        <div style="background:#003b5c; color:#00b5e2; height: 40%; width: 40%; border-style: solid "> 
                        NO HAY CATEGORIAS DE  COMPETENCIAS <br>REGISTRADAS. <br>
                        </div>
                      </center>
                      <br><br>
          @endif

            <center><a href="{{ URL::to('/competencia') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a></center>

     </section>

@endsection