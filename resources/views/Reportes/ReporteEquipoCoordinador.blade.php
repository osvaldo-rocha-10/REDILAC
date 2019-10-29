<!DOCTYPE html>
<html>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="all,follow">
<head>
	 
</head>

<style type="text/css">
  
     #izquierda{
          width: 80px;
          height: 100px;
          float: left;
          position: fixed;
     }
     #izquierda img{
     	   position: absolute;
           top: 17px;
           left: 5px;
     }
     #centro{
     	width: 900px;
     	height: 100px;
     	float: left;
      position: fixed;

     }
     #derecha{
     	width: 50px;
     	height: 30px;
     	float: left;
     }

     #centro div{
     	width: 200px;
     	height: 100px;
     	position: absolute;
           top: 20px;
           left: 750px;
     }
     #contenedor-tabla{
     	   position: absolute;
         top: 120px;
         left: 0px;
         width: 1028px;
         height: 560px;
        border: 1px solid #999;
     }
      #FirmaDirecto{
       width: 220px;
       height: 150px;
       float:  right;
       margin: 15px;
     }
      #FirmaResponsable{
        width: 220px;
       height: 150px;
       float: right;

     }
     #vinculo{
       top: 560px;
       left: 500px;
       position: absolute;
     }
     h6{
        font-size: 10px;
     }
     p{
        font-size: 10px;
     }
     table {
         width: 100%;
         height: 10%;
         text-align: left;
         border-top: 1px solid #999;
         border-collapse: collapse;
         margin: 0 0 1em 0;
         caption-side: top;
         table-layout:fixed;
     }
     th, td {
      border-bottom: 1px solid #999;
      padding: -20px;
      
    }
    .pagina{
          page-break-before:always;
    }
  }
</style>

<body>
 
 <script type="text/php">
    if ( isset($pdf) ) {
        $font = $fontMetrics->getFont("helvetica", "bold");
        $pdf->page_text(657, 65,  "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, 11, array(0,0,0));
        $pdf->page_text(657, 95,  "Reporte:{{{$reporte}}}", $font, 11, array(0,0,0));
        $pdf->page_text(657, 80,  "Fecha: {{{$fecha}}}", $font, 11, array(0,0,0));
        $pdf->page_text(657, 110, "Usuario: {{{Auth::User()->idCoordinador}}}", $font, 11, array(0,0,0));
    }
</script>
  


    <div id="izquierda">
    	   <img src="{{ asset('img/Logos/Navegador.png') }}" style="width: 70px; height: 70px;">
    </div>

      <div id="centro">
    		<center>
                 <b>SISTEMA ADMINISTRATIVO DE INFORMACIÓN DE ESPACIOS EDUCATIVOS (REDILAC-EMS)</b><br>
                             DIRRECCIÓN GENERAL DE CONTROL PATRIMONIAL <br>
                                  @if($estatus==0)
                                    RELACIÓN DE BIENES CON ESTATUS BAJA <br>
                                   @endif

                                 @if($tipo_reporte==1)
                                    {{{$academia}}}/{{{$instalacion}}} <br>
                                     @if($tipo!="")
                                         CATEGORIA: {{{$tipo->Categoria}}} <br>    
                                     @endif
    		                          @else  
                                     {{{$academia}}} <br>
                                      @if($tipo!="")
                                         CATEGORIA: {{{$tipo->Categoria}}} <br>    
                                     @endif
                                  @endif


      </center>         
    	</div>

        <div id="derecha">
        	<h5></h5>

        </div>
    
  <div id="contenedor-tabla">
   <p>UNIDAD ACADEMICA ADMINISTRATIVA: <strong><u>ESC.PREP.LIC.BENITO.JUAREZ.GARCIA.</u></strong></p>
    <table >
          <thead>
                  <tr>
                      <th><center><h6>CANTIDAD</h6></center></th>
                      <th><h6>NO.INVENTARIO</h6></th>
                      <th><h6>DESCRIPCIÓN<br>DEL BIEN</h6></th>
                      <th><h6>NO.EDIFICIO</h6></th>
                      <th><h6>UBICACIÓN</h6></th>
                      <th><h6>MARCA</h6></th>
                      <th><h6>MODELO</h6></th>
                      <th><h6>SERIE</h6></th>
                      <th><h6>OBSERVACIÓN1</h6></th>
                      <th><h6>OBSERVACIÓN2</h6></th>
                   </tr>
                  
         </thead>
          <tbody>
                      <?php 
                         $cantidad = 0;
                         $pag = 1;
                       ?>
                        @foreach ($equipo as $equipos)
                          <tr>
                            <td><center><h6>1</h6></center></td>
                            <td><h6>{{{$equipos->NoInventario}}}</h6></td>
                            <td><h6>{{{$equipos->Categoria}}}</h6></td>
                            <td><h6>{{{$equipos->NoEdificio}}}</h6></td>
                            <td><h6>{{{$equipos->Ubicacion}}}</h6></td>
                            <td><h6>{{{$equipos->Marca}}}</h6></td>
                            <td><h6>{{{$equipos->Modelo}}}</h6></td>
                            <td><h6>{{{$equipos->Serie}}}</h6></td>
                            <td><h6>{{{$equipos->Observacion1}}}</h6></td>
                            <td><h6>{{{$equipos->Observacion2}}}</h6></td>
                          </tr>
                            <?php 
                               $cantidad+=1;
                             ?>
                             @if($cantidad%20==0)
                              </tbody></table></div>
                               <div class="pagina"></div>
                               @php($pag+=1)
                               <div id="contenedor-tabla">
                               <p>UNIDAD ACADEMICA ADMINISTRATIVA: <strong><u>ESC.PREP.LIC.BENITO.JUAREZ.GARCIA.</u></strong></p>
                               <table>
                                  <thead>
                                         <tr>
                                           <th><center><h6>CANTIDAD</h6></center></th>
                                           <th><h6>NO.INVENTARIO</h6></th>
                                           <th><h6>DESCRIPCIÓN<br>DEL BIEN</h6></th>
                                           <th><h6>NO.EDIFICIO</h6></th>
                                           <th><h6>UBICACIÓN</h6></th>
                                           <th><h6>MARCA</h6></th>
                                           <th><h6>MODELO</h6></th>
                                           <th><h6>SERIE</h6></th>
                                           <th><h6>OBSERVACIÓN1</h6></th>
                                           <th><h6>OBSERVACIÓN2</h6></th>
                                         </tr>
                                  </thead>
                                  <tbody>

                             @endif
                         </tr>
                        @endforeach

          </tbody>
    </table>


      <h6>TotalCantidad:{{$cantidad}}</h6>
      <p>Los bienes relacionados en el presente control de equipos de: <b>{{{$pag}}} hoja(s)</b> , forman parte del inventario general de bienes de esta Unidad Académica/Administrativa , de los cuales me responsabilizo en terminos de lo establecido en los articulos 68 y 71 de Reglamento de la Administración de los bienes  que integran el Patrimonio Universitario  de la Benémerita Universidad Autonoma de Puebla.</p>
   </div> 
     
    
  
</body>
</html>
