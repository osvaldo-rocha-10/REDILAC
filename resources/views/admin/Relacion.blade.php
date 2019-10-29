@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>C_R_L</title>

       <!-- Libreria js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
     <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Competencia_Recurso_Laboratorio</li>
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
            <div class="card-header py-3">
               <div class="row d-flex">
                  <div class="col-lg-7">
                    <div class="card income">
                      <h6 class="m-0 font-weight-bold text-primary">  

                      Instrucciones:  <br> <br> 
                      1.-Modifique,agregue o elimine las competencias de un recurso digital.<br>
                      2.-Seleccione un recurso digital para visualizar las competencias.<br>
                      3.-Si desea realizar una busqueda de la forma Instalación-RecursoDigital seleccione aqui   
                      <a href="{{{route('relacion.busqueda')}}}"><button type="button" class="boton_EE" style="height: 20px; width: 30px;"><i class="fas fa-search"></i></button></a> <br>
                      4.-Agrege un Recurso Digital a una determinada Instalación ó Laboratorio. <br><br>
                      RecursoDigital
                     <select name="Recurso" id="Recurso">
                         <option value="">Seleccione recurso</option>
                                @foreach ($recurso as $recursos)
                                          <option value="{{{$recursos->idRecursoDigital}}}">"{{{$recursos->RecursoDigital}}}"</option>
                                @endforeach
                     </select>
                      <br>
                      @csrf
                      </h6>
                  </div>
               </div>
                   <div class="col-lg-5">
                    <div class="card income text-center">
                      <h6 class="m-0 font-weight-bold text-primary"> 
                       <br> <br><br>
                        Si desea visualizar y realizar operaciones de alguna Categoria/Competencia <br><br><br><br>
                                <a href="{{ route('tipo_competencia.index') }}"> Seleccione aqui (CATEGORIA DE COMPETENCIA)</a>
                      <br>
                      </h6>
                  </div>
               </div>
             </div>
          </div>

            <div class="card-body" id="RL">
               <div class="Botones" style="display: none;">
                 <center><a id="agregar" href="">
                  <button type="button" class="boton_EE" style="height: 60px;">Agregar <br>Competencia</button>
                </a>
                <a id="asignar" href="">
                  <button type="button" class="boton_EE" style="height: 60px; width: 130px;">Asignar <br> Laboratorio</button>
                </a></center> <br>
              </div>
             <center><h4 id="tc" style="display: none;">COMPETENCIA / RECURSO DIGITAL</h4></center>
              <div class="table-responsive">

                    <form id="EliminarCompetencia" name="formulario" method="post" action="">
                           @method('put')
                           @csrf
                           <table class="table table-sm " width="100%" cellspacing="0" id="competencia">
                     
                            </table>
                            <center><input  id="ec" type="submit" class="boton_EE" value="Eliminar Competencia" style="display: none;"></center>
                    </form>
                </div>

                 <center><h4 id="ti" style="display: none;">INSTALACIÓN / RECURSO DIGITAL</h4></center>
              

               <div class="table-responsive">
                 <form id="EliminarInfraestructura" name="formulario" method="post" action="">
                      @method('put')
                      @csrf
                      <table class="table table-sm " width="100%" cellspacing="0" id="laboratorio">
                     
                      </table>
                        <center>
                          <input id="ei" type="submit" class="boton_EE" value="Eliminar Instalación" style="display: none;">
                        </center>
                  </form>
               
             
                    <a href="{{url()->previous()}}"><button type="button" class="boton_EE"><i class="fas fa-reply"></i></button></a>
              </div>
 
          </div>
        </div>
      </div>
     </section>
     
     <script type="text/javascript">
       $("#Recurso").change(function(){
            
            if($('select[id=Recurso]').val()!=''){

               var select = $(this).attr("id");
               var value = $('select[id=Recurso]').val();

               $("#agregar").attr("href", "{{ route('relacion.agregar',['id' => 0 ])}}".replace("0",value));
               $("#asignar").attr("href", "{{ route('relacion.asignar',['id' => 0 ])}}".replace("0",value));
               $("#EliminarCompetencia").attr("action", "{{ route('relacion.eliminar',0)}}".replace("0",value));
               $("#EliminarInfraestructura").attr("action", "{{ route('relacion.quitar',0)}}".replace("0",value));

               var _token = $('input[name="_token"]').val();

               $.ajax({
                    url:"{{route('relacion.GenerarTablaCompetencia')}}",
                    method: "POST",
                    data:{select:select, value:value, _token:_token},
                    success:function(result){
                        $('.Botones').show('slow');
                        $('#competencia').html(result); 

                       if(result!=''){
                          $('#ec').show();
                          $('#tc').show();
                       }
                       else {
                          $('#ec').hide(); 
                          $('#tc').hide();       
                       }
                    }
               })
               $.ajax({
                    url:"{{route('relacion.GenerarTablaLaboratorio')}}",
                    method: "POST",
                    data:{select:select, value:value, _token:_token},
                    success:function(result){
                       $('.Botones').show('slow');
                       $('#laboratorio').html(result);

                       if(result!=''){
                          $('#ei').show();
                          $('#ti').show();
                       }
                       else {
                          $('#ei').hide(); 
                          $('#ti').hide();       
                       }
                     }
                      
               })

            }
              
       }
    );

  $('#EliminarCompetencia').submit(function(e){

    if ($('input[name="competencia[]"]:checked').length === 0) {
        e.preventDefault();
        alert('Debe seleccionar al menos un valor de Competencia');
    }
  });

   $('#EliminarInfraestructura').submit(function(e){

    if ($('input[name="infraestructura[]"]:checked').length === 0) {
        e.preventDefault();
        alert('Debe seleccionar al menos un valor de Instalación');
    }
  });


     </script>

@endsection