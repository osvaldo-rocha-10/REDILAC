@extends('layouts.app') <!-- Herencia de plantilla blade -->

       <title>instalacion_equipo</title>

       <!-- Librerias js -->
       <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
       <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
       <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


@section('content')
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">INICIO</a></li>
            <li class="breadcrumb-item active">SUBSECCIÓN 4.5 CONSULTAS Y REPORTES FILTRO 2</li>
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

   
        <form method="post" action="{{ route('reporte.AcademiaInstalacion') }}" target="_blank">
          @csrf
         <div class="container-fluid">
          <div class="card shadow mb-4">
                <div class="card income"  style="border-color: #003b5c;  border-width: 2px; padding: 10px; margin: 3px;">
                     <center> 
                      <h6 class="m-0 font-weight-bold text-primary"> 4.5 CONSULTAS Y REPORTES FILTRO 2</h6>
                     </center> <br>

                       <div class="row">
                          
                          <div class="col-md-12">
                            <center>  
                              <h6 class="m-0 font-weight-bold text-primary">
                                  
                                   4.5.1.- Seleccione filtro por "Dirección/Academia":
                                     <select name="academia" id="academia" data-dependent ="instalacion">
                                        <option value="">D/A</option>
                                          @foreach ($academia as $academias)
                                             <option  data-academia ="{{{$academias->Academia}}}" value="{{{$academias->idAcademia}}}">{{{$academias->Academia}}}</option>
                                          @endforeach
                                      </select> <br><br>

                                    4.5.2.-Seleccione filtro por "Instalación":
                                         <select name="instalacion" id="instalacion" data-dependent = "categoria">
                                            <option value="">SN-INSTALACIÓN</option>
                              
                                           </select> <br> <br>
                                    4.5.3.-(Opcional) Seleccione filtro por "Categoria de Equipo":
                                     <select name="categoria" id="categoria">
                                            <option value="">SN-CATEGORIA</option>
                              
                                      </select> <br> <br>
                                    4.5.4.-Descargue en formatos PDF y EXCEL, ademas de guardar e imprimir reportes desde el sistema.
                                </h6>
                            </center>
                          </div> 
                          
                      </div>
                      @csrf
                </div> 
            <div class="card-body" id="RL">
           
             <center>
               <div id ="informacion" style="display: none;">
                <h4 id="titulo"></h4> <br>
                 
                    
                          <button type="submit" name="descargaPDF" class="boton_EE btn btn-primary" value="pdf" style="height:50px; ">
                           <i class="fas fa-arrow-down"></i> Reporte PDF <i class="fas fa-file-pdf"></i>
                          </button>

                          <button type="submit" name="descargaEXCEL" class="boton_EE btn btn-primary" value="excel" style="height:50px; ">
                          <i class="fas fa-arrow-down"></i>  Lista Excel <i class="fas fa-file-excel"></i>
                          </button>
               
                          <button type="submit" name="guardar" class="boton_EE btn btn-primary" value="guardar" style="height:50px; ">
                           <i class="fas fa-save"></i> Guardar Reporte.
                          </button>
                          <button type="submit" name="imprimir" class="boton_EE btn btn-primary" value="imprimir" style="height:50px; >
                           <i class="fas fa-print"></i> Imprimir Reporte
                          </button>
                  
                   
                    

                </div>
                <div id ="mensaje" style="display: none;" class="alert alert-danger">

                </div>
              </center>

              <br><br>
              <div class="table-responsive">

                  <table class="table table-sm table-striped " width="100%" cellspacing="0" id="equipo_instalacion">
                     
                  </table>
              
              </div>

                 <br>
                 <center><a href="{{ route('formato.FR')}}">
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
       var academia = "";
       var instalacion = "";
       var categoria = "";

       $("#academia").change(function(){
            
            if($('select[id=academia]').val()!=''){
               //var select = $(this).attr("id"); 
               var dependent = $(this).data('dependent'); 
               var value = $('select[id=academia]').val(); 
               academia = $(this).find(':selected').data('academia');
               var _token = $('input[name="_token"]').val(); 
              
                 $.ajax({
                    url:"{{route('equipo.ComboboxI')}}",  //Combobox Instalación.
                    method: "POST",
                    data:{value:value,academia:academia,_token:_token},
                    success:function(result){
                       $('#'+dependent).html(result);
                       $('#categoria').html('<option value="" >SN-CATEGORIA</option>');
                       $('#equipo_instalacion').html('');
                       $('#informacion').hide();  
                    }
               })
               
            }    
       }
     );
    
   $("#instalacion").change(function(){
        if($('select[id=instalacion]').val()!=''){
             var value = $('select[id=instalacion]').val();
             var dependent = $(this).data('dependent');
             var _token = $('input[name="_token"]').val();
              instalacion = $(this).find(':selected').data('instalacion');


              $.ajax({
                    url:"{{route('equipo.ComboboxIC')}}",  //Combobox InstalacionCategoria.
                    method: "POST",
                    data:{value:value,_token:_token},
                    success:function(result){
                        if(result!='')
                          $('#'+dependent).html(result);
                        else
                           $('#'+dependent).html("<option value=''>SN-CATEGORIA</option>");
                    }
               })

             $.ajax({
                    url:"{{route('equipo.TablaI')}}",      //TablaInstalación.
                    method: "POST",
                    data:{value:value,_token:_token},
                    success:function(result){
                        $('#equipo_instalacion').html(result);
                        if(result!=''){
                          $('#informacion').show();
                          $('#mensaje').hide();
                          $('#titulo').html(" <div class='alert alert-success'role='alert'>ACADEMIA:"+academia+" / INSTALACIÓN: "+instalacion+"</div>");
                       }
                       else {
                          $('#informacion').hide(); 
                          $('#mensaje').show();
                          $('#mensaje').html('S/N EQUIPOS EN INSTALACIÓN: '+instalacion);
                       }
                    }
               })
        }
   });
   
   $("#categoria").change(function(){
        if($('select[id=categoria]').val()!=''){
             var value = $('select[id=categoria]').val();
             var _token = $('input[name="_token"]').val();
             var value_instalacion = $('select[id=instalacion]').val();
             categoria = $(this).find(':selected').data('categoria');

             $.ajax({
                    url:"{{route('equipo.TablaIC')}}",  //TablaInstalacionCategoria
                    method: "POST",
                    data:{value:value,value_instalacion:value_instalacion,_token:_token},
                    success:function(result){

                          $('#equipo_instalacion').html(result);
                          if(result!=''){
                            $('#titulo').html(" <div class='alert alert-success'role='alert'>ACADEMIA:"+academia+" / INSTALACIÓN: "+instalacion+" / "+categoria+"</div>");
                          }
                       

                    }
               })
        }
   });

   function imprimir(){

   }
     
  
  </script>

@endsection