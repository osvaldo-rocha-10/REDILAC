@extends('layouts.app')

       <title>BajaEquipo</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.area') }}">Inicio</a></li>
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
                      <h6 class="m-0 font-weight-bold text-primary"> 2.3 BAJA EQUIPO.</h6>
                     </center> <br>

                       <div class="row">
                          
                          <div class="col-md-12">
                            <center>  
                              <h6 class="m-0 font-weight-bold text-primary">
                                  <span id="academia">ACADEMIA : {{{$academia->Academia}}} </span><br> <br>

                                   2.3.1.- Seleccione filtro por "Instalación":
                                     <select name="instalacion" id="instalacion">
                                        <option value="">Seleccione instalación</option>
                                          @foreach ($instalacion as $instalaciones)
                                             <option  data-instalacion ="{{{$instalaciones->Nomenclatura}}}" value="{{{$instalaciones->idInstalacion}}}">{{{$instalaciones->Nomenclatura}}}</option>
                                          @endforeach
                                      </select> <br><br>
                                     2.3.2.-(Opcional) Seleccione filtro por "Categoria de Equipo".
                                     <select name="categoria" id="categoria">
                                            <option value="">SN-CATEGORIA</option>
                              
                                      </select> <br> <br>
                                    2.3.3.- Para realizar una busqueda mas profunda, busque de manera automatica por NoInventario al momento de seleccionar el filtro "Dirrección-Academia y/o Categoria de Equipo"<br> <br>
                                    2.3.4.-Seleccione en "Baja de Equipos" para su Baja-Temporal que usted ha seleccionado. 
                                   
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
                <div id ="mensaje" style="display: none;" class="alert alert-danger">

                </div>
              </center>
              <div class="table-responsive">
              
                  <form method="post" action="{{ route('equipo.baja_lista') }}" id="BajaEquipos">
                    @csrf
                    @method('put')
                    <table class="table table-striped table-sm equipo_instalacion"  width="100%" cellspacing="0">
                     
                    </table>

                   <center>
                 
                  <input id="baja" type="submit" class="informacion boton_EE btn btn-primary" value="Baja de Equipos" style="display: none;">
                   </center>
                 </form>
                  
              </div>

                 <br>

                 <center><a href="{{ URL::to('/equipo/area') }}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
                </center>
          </div>
        </div>
       </div>
     </section>


     <script type="text/javascript">
       var nomenclatura= "";
       var tipo = "";
       

         $("#instalacion").change(function(){
            
            if($('select[id=instalacion]').val()!=''){
               var instalacion = $('select[id=instalacion]').val(); 
               nomenclatura = $(this).find(':selected').data('instalacion');
               var _token = $('input[name="_token"]').val(); 
              
                 $.ajax({
                    url:"{{route('equipo.combobox_ic',['estatus' => 1])}}", 
                    method: "POST",
                    data:{instalacion:instalacion,_token:_token},
                    success:function(result){

                      if(result!='')
                         $('#categoria').html(result);
                       else
                         $('#categoria').html("<option value=''>SN-CATEGORIA</option>");
                    }
               })

                $.ajax({
                    url:"{{route('equipo.tabla_i',['opc' => 1,'estatus' => 1])}}",      
                    method: "POST",
                    data:{instalacion:instalacion,_token:_token},
                    success:function(result){
                        $('.equipo_instalacion').html(result);

                        if(result!=''){
                          $('.informacion').show();
                          $('#mensaje').hide();
                          $('#titulo').html(" <div class='alert alert-success'role='alert'>INSTALACIÓN:"+nomenclatura+"</div>");
                       }
                       else {
                          $('.informacion').hide(); 
                          $('#mensaje').show();
                          $('#mensaje').html('S/N EQUIPOS EN INSTALACIÓN: '+nomenclatura);
                       }
                    }
               })

               
            }    
       }
     );

     $("#categoria").change(function(){
        if($('select[id=categoria]').val()!=''){
             var categoria= $('select[id=categoria]').val();
             var _token = $('input[name="_token"]').val();
             var instalacion = $('select[id=instalacion]').val();
             tipo = $(this).find(':selected').data('categoria');

             $.ajax({
                    url:"{{route('equipo.tabla_ic',['opc' => 1,'estatus' => 1])}}",  
                    method: "POST",
                    data:{categoria:categoria,instalacion:instalacion,_token:_token},
                    success:function(result){
                          
                          $('.equipo_instalacion').html(result);
                          if(result!=''){
                            $('#titulo').html(" <div class='alert alert-success'role='alert'> INSTALACIÓN: "+nomenclatura+" / "+tipo+"</div>");
                          }
                       

                    }
               })
        }
   });
   $(document).ready(function(){

       $("#busqueda").keyup(function(){
           var busqueda = $("#busqueda").val();
           var instalacion = $('select[id=instalacion]').val();
           var categoria = $('select[id=categoria]').val();
           var _token = $('input[name="_token"]').val();

          if(categoria==''){
            $.ajax({
                    url:"{{route('equipo.tabla_ib',['opc' => 1,'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,instalacion:instalacion,_token:_token},
                    success:function(result){
                      if(result!='')
                         $('.equipo_instalacion').html(result);
                      else
                        $('.equipo_instalacion').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
                    },
                    error: function(){
                        //  alert("Error en la peticion de datos");
                    }

               })
          }else{

              $.ajax({
                    url:"{{route('equipo.tabla_ibc',['opc' => 1,'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,categoria:categoria,instalacion:instalacion,_token:_token},
                    success:function(result){
                      if(result!='')
                        $('.equipo_instalacion').html(result);
                      else
                        $('.equipo_instalacion').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
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