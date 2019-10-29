@extends('layouts.app')

       <title>ConsultasReportes</title>
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.area') }}">Inicio</a></li>
             <li class="breadcrumb-item active">SUBSECCIÓN CONSULTAS Y REPORTES</li>
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
            @php($reporte = "R".time())
   
       <form method="post" action="{{{route('reporte.generar',['estatus' => 1,'tipo' => 2])}}}">
          @csrf
         <div class="container-fluid">
          <div class="card shadow mb-4">
                <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
                     <center> 
                      <h6 class="m-0 font-weight-bold text-primary"> 3.4 CONSULTAS Y REPORTES.</h6>
                     </center> <br>

                       <div class="row">
                          
                          <div class="col-md-12">
                            <center>  
                              <h6 class="m-0 font-weight-bold text-primary">
                                  
                                   ACADEMIA: <input type="text" value="{{$academia->Academia}}" style=" width: 10%" disabled readonly="readonly" />

                                    <input type="text" name="academia" value="{{$id_a}}" style="display: none;">
                                   <br><br>
                                
                                   3.4.1.- Seleccione filtro por "Instalación":
                                     <select name="instalacion" id="instalacion">
                                        <option value="">Seleccione instalación</option>
                                          @foreach ($instalacion as $instalaciones)
                                             <option  data-instalacion ="{{{$instalaciones->Nomenclatura}}}" value="{{{$instalaciones->idInstalacion}}}">{{{$instalaciones->Nomenclatura}}}</option>
                                          @endforeach
                                      </select> <br><br>
                                    3.4.2.-(Opcional) Seleccione filtro por "Categoria de Equipo".
                                     <select name="categoria" id="categoria">
                                            <option value="">SN-CATEGORIA</option>
                              
                                      </select> <br> <br>
                                    3.4.3.- Para realizar una busqueda mas profunda, busque de manera automatica por NoInventario al momento de seleccionar el filtro "Instalación y/o Categoria de Equipo"<br> <br>

                                    3.4.4.-Descargue en formatos PDF y EXCEL, ademas de guardar e imprimir reportes desde el sistema.
                                </h6>
                            </center>
                          </div> 
                          
                      </div>
                      @csrf
                </div> 
            <div class="card-body" id="RL">
           
             <center>
             
               <div class="informacion" style="display: none;">

                <h4 id="titulo"></h4>
                   <h5 class="m-0 font-weight-bold text-primary">  
                      Busqueda  <input type="search" id="busqueda" name="busqueda" placeholder="No.Inventario">
                   </h5> 
                <br>
                <h4 id="titulo"></h4> <br>
                 
                        <div class="botones">
                          <button type="submit" name="pdf" class="boton_EE btn btn-primary" value="pdf" style="height:50px; ">
                           <i class="fas fa-arrow-down"></i> Reporte PDF <i class="fas fa-file-pdf"></i>
                          </button>

                          <button type="submit" name="excel" class="boton_EE btn btn-primary" value="excel" style="height:50px; ">
                          <i class="fas fa-arrow-down"></i>  Lista Excel <i class="fas fa-file-excel"></i>
                          </button>
               
                          <button type="submit" name="guardar" class="boton_EE btn btn-primary" value="guardar" id="guardar" style="height:50px; ">
                           <i class="fas fa-save"></i> Guardar Reporte.
                          </button>
                          <button type="submit" name="imprimir" class="boton_EE btn btn-primary" value="imprimir" style="height:50px;"  formtarget="_blank">
                           <i class="fas fa-print"></i> Imprimir Reporte
                          </button>
                      </div>
                   
                    

                </div>
                <div id ="mensaje" style="display: none;" class="alert alert-danger">

                </div>
              </center>

              <br><br>
              <div class="informacion"  style="display: none;">
                 <h6 class="m-0 font-weight-bold text-primary">  Reporte: <input type="" name="reporte" value="{{$reporte}}" style=" width: 10%"></h6> <br>
              </div>
              <div class="table-responsive">

                  <table class="table table-sm table-striped " width="100%" cellspacing="0" id="equipo_instalacion">
                     

                   
                  </table>
              </div>
                 <br>

                 <center><a href="{{{route('formato_reporte.area')}}}">
                    <button type="button" class="boton_EE btn btn-primary">
                      <i class="fas fa-reply"></i> Regresar
                      </button>
                    </a>
                </center>   
          </div>
        </div>
       </div>
     </form>
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
                    $('#busqueda').val("");
                      if(result!='')
                         $('#categoria').html(result);
                       else
                         $('#categoria').html("<option value=''>SN-CATEGORIA</option>");
                    }
               })

                $.ajax({
                    url:"{{route('equipo.tabla_i',['opc' => 2,'estatus' => 1])}}",      
                    method: "POST",
                    data:{instalacion:instalacion,_token:_token},
                    success:function(result){
                        $('#equipo_instalacion').html(result);

                        if(result!=''){
                          $('.informacion').show();
                          $('#mensaje').hide();
                          $('#titulo').html(" <div class='alert alert-success'role='alert'>INSTALACIÓN:"+nomenclatura+"</div>");
                       }
                       else {
                          $('.informacion').hide(); 
                          $('#mensaje').show();
                          $('#mensaje').html('NO HAY EQUIPOS EN "INSTALACIÓN: '+nomenclatura+'"-  EN ESTE MOMENTO.'); 
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
                    url:"{{route('equipo.tabla_ic',['opc' => 2,'estatus' => 1])}}",  
                    method: "POST",
                    data:{categoria:categoria,instalacion:instalacion,_token:_token},
                    success:function(result){
                          $('#busqueda').val("");
                          $('#equipo_instalacion').html(result);
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
                    url:"{{route('equipo.tabla_ib',['opc' => 2,'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,instalacion:instalacion,_token:_token},
                    success:function(result){
                      if(result!=''){
                         $('.botones').show();
                         $('#equipo_instalacion').html(result);
                      }
                      else{
                         $('.botones').hide();
                         $('#equipo_instalacion').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
                      }
                    },
                    error: function(){
                        //  alert("Error en la peticion de datos");
                    }

               })
          }else{

              $.ajax({
                    url:"{{route('equipo.tabla_ibc',['opc' => 2,'estatus' => 1])}}", 
                    method: "POST",
                    data:{busqueda:busqueda,categoria:categoria,instalacion:instalacion,_token:_token},
                    success:function(result){
                      if(result!=''){
                         $('.botones').show();
                        $('#equipo_instalacion').html(result);
                      }
                      else{
                         $('.botones').hide();
                        $('#equipo_instalacion').html("<center><h5 class='m-0 font-weight-bold text-primary'>No se encontrarón coincidencias</h5> </center>");
                      }
                    },
                    error: function(){
                          //alert("Error en la peticion de datos");
                    }

               })
          }
       });   

      
  });


  </script>
@endsection