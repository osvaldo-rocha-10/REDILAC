@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>C_R_L</title>

        <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')  <!-- Sección inicial blade -->
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Competencia_Recurso_Laboratorio</li>
          </ul>
        </div>
     </div>

      <!-- div mensaje exitoso al realizar una operación desde controlador  -->
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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">  
                Instrucciones:  <br>
                1.-Seleccione una Infraestructura/Instalacion ó Laboratorio para visualizar los Recursos Digitales disponibles.<br><br>
                Instalación
                 <select name="infraestructura" id="infraestructura">
                         <option value="">Seleccione Nomenclatura</option>
                                @foreach ($infraestructura as $infraestructuras)
                                          <option value="{{{$infraestructuras->idInfraestructura}}}">{{{$infraestructuras->Nomenclatura}}}</option>
                                @endforeach
                 </select>
              </h6>
            </div>

            <div class="card-body" id="RL">
             <center><h4 id="tc" style="display: none;">RECURSOS DIGITALES</h4></center>
              <center> <div id="aviso" style="background:#00b5e2; color: white; height: 40%; width: 40%; border-style: solid; border-color: #003b5c; display: none;"> NO HAY RECURSOS REGISTRADOS<br></div></center>
              <div class="table-responsive">
                           <table class="table table-sm " width="100%" cellspacing="0" id="instalacion">
                     
                            </table>
                       <a href="{{url()->previous()}}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
              </div>
          </div>
        </div>
      </div>
     </section>
     
     <!-- SCRIPT AJAX   -->
     <script type="text/javascript">
       $("#infraestructura").change(function(){
            
            if($('select[id=infraestructura]').val()!=''){

               var select = $(this).attr("id");
               var value = $('select[id=infraestructura]').val();
               var _token = $('input[name="_token"]').val();

               $.ajax({
                    url:"{{route('relacion.GenerarTablaBusqueda')}}",
                    method: "POST",
                    data:{select:select, value:value, _token:_token},
                    success:function(result){
                        $('#instalacion').html(result); 

                       if(result!=''){
                          $('#tc').show();
                          $('#aviso').hide();
                       }
                       else {
                          $('#aviso').show();
                          $('#tc').hide();       
                       }
                    }
               })
            }
              
       }
    );
 </script>

@endsection