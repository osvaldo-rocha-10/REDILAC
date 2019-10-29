@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>baja_equipos</title>
       
       <!-- Librerias js-->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.administrador') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SUBSECCIÓN BAJA EQUIPO</li>
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
                     <center> 
                      <h6 class="m-0 font-weight-bold text-primary"> 3.3 BAJA EQUIPO.</h6>
                     </center> <br>

                       <div class="row">
                          
                          <div class="col-md-12">
                            <center>  
                              <h6 class="m-0 font-weight-bold text-primary">
                                  
                                   3.3.1.- Seleccione filtro por "Dirección/Academia":
                                     <select name="academia" id="academia">
                                        <option value="">D/A</option>
                                          @foreach ($academia as $academias)
                                             <option  data-academia ="{{{$academias->Academia}}}" value="{{{$academias->idAcademia}}}">{{{$academias->Academia}}}</option>
                                          @endforeach
                                      </select> <br><br>
                                     3.3.2.-(Opcional) Seleccione filtro por "Categoria de Equipo".
                                     <select name="categoria" id="categoria">
                                            <option value="">SN-CATEGORIA</option>
                              
                                      </select> <br> <br>
                                    3.3.3.- Para realizar una busqueda mas profunda, busque de manera automatica por NoInventario al momento de seleccionar el filtro "Dirrección-Academia y/o Categoria de Equipo"<br> <br>

                                    3.3.4.-Seleccione en "Baja de Equipos" para su Baja-Temporal que usted ha seleccionado. 
                                   
                                </h6>
                            </center>
                          </div> 
                          
                      </div>
                      @csrf
                </div> 
            <div class="card-body" id="RL">
           
             <center>
               <div class ="informacion" style="display: none;">
                  <h4 id="titulo"></h4>
                   <h5 class="m-0 font-weight-bold text-primary">  
                      Busqueda  <input type="search" id="busqueda" placeholder="No.Inventario">
                   </h5> 
                   <br>
                </div>
              </center>
              <div class="table-responsive">
              
                  <form method="post" action="{{ route('equipo.baja_lista') }}" id="BajaEquipos">
                    @csrf
                    @method('put')
                    <table class="table table-striped table-sm equipo_academia"  width="100%" cellspacing="0">
                     
                    </table>

                   <center>
                 
                  <input id="baja" type="submit" class="informacion boton_EE btn btn-primary" value="Baja de Equipos" style="display: none;">
                   </center>
                 </form>
                  
              </div>

                 

                
          </div>

        </div>
         <center><a href="{{ URL::to('/equipo/administrador') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
                </center>
       </div>
     </section>


     <script type="text/javascript">
       var academia = "";
       var categoria = "";

       $("#academia").change(function(){
            
            if($('select[id=academia]').val()!=''){
               var value = $('select[id=academia]').val(); 
               academia = $(this).find(':selected').data('academia');
               var _token = $('input[name="_token"]').val(); 
              
                 $.ajax({
                    url:"{{route('equipo.combobox_ac',['estatus' => 1])}}", 
                    method: "POST",
                    data:{value:value,_token:_token},
                    success:function(result){

                      if(result!='')
                         $('#categoria').html(result);
                       else
                         $('#categoria').html("<option value=''>SN-CATEGORIA</option>");
                    }
               })

                $.ajax({

                    url:"{{route('equipo.tabla_a',['opc' => 1,'estatus' => 1])}}",
                    method: "POST",
                    data:{value:value,_token:_token},

                    success:function(result){
                       $('.equipo_academia').html(result);
                        if(result!=''){
                          $('.informacion').show();
                          $('#titulo').html(" <div class='alert alert-success'role='alert'>ACADEMIA:"+academia+"</div>");
                       }
                       else {
                          $('.informacion').hide();       
                       }
                     
                    }
               })


               
            }    
       }
     );

       $("#categoria").change(function(){
        if($('select[id=categoria]').val()!=''){

              var value_categoria = $('select[id=categoria]').val();
              var value_academia = $('select[id=academia]').val();
              var _token = $('input[name="_token"]').val();
              categoria = $(this).find(':selected').data('categoria');

                 $.ajax({
                    url:"{{ route('equipo.tabla_ac',['opc' => 1,'estatus' => 1])}}",
                    method: "POST",
                    data:{value_categoria:value_categoria,value_academia:value_academia,_token:_token},
                    success:function(result){
                      $('.equipo_academia').html(result);
                      if(result!='')
                           $('#titulo').html(" <div class='alert alert-success'role='alert'>ACADEMIA:"+academia+"/"+categoria+"</div>");
                      
                    }
               })
        }
   });


   $(document).ready(function(){

       $("#busqueda").keyup(function(){
           var busqueda = $("#busqueda").val();
           var value_academia = $('select[id=academia]').val();
           var value_categoria = $('select[id=categoria]').val();
           var _token = $('input[name="_token"]').val();

          if(value_categoria==''){
            $.ajax({
                    url:"{{route('equipo.tabla_ab',['opc' => 1, 'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,value_academia:value_academia,_token:_token},
                    success:function(result){
                      if(result!='')
                         $('.equipo_academia').html(result);
                      else
                        $('.equipo_academia').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
                    },
                    error: function(){
                        //  alert("Error en la peticion de datos");
                    }

               })
          }else{

              $.ajax({
                    url:"{{route('equipo.tabla_abc',['opc' => 1, 'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,value_categoria:value_categoria,value_academia:value_academia,_token:_token},
                    success:function(result){
                      if(result!='')
                        $('.equipo_academia').html(result);
                      else
                        $('.equipo_academia').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
                    },
                    error: function(){
                          //alert("Error en la peticion de datos");
                    }

               })
          }
       });   

      
  });


  $('#BajaEquipos').submit(function(e){
    if ($('input[name="equipo[]"]:checked').length === 0) {
        e.preventDefault();
        alert('Debe seleccionar al menos NoInventario');
    }
  });

  </script>
@endsection