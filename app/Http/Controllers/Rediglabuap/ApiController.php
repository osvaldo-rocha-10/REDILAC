<?php

namespace App\Http\Controllers\Rediglabuap;

/*Librerias*/
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

/*Modelos*/
use App\Models\caracteristicas_equipo;
use App\Models\instalacion;
use App\Models\academia;
use App\Models\equipo;
use App\Models\tipo_equipo;
use App\Models\historial;



/*1.-Controlador API_REST

2.-Tipo => Normal

3.-Funciones => 
    getInstalaciones() => GET, 
    storeEquipo(Request $request) => POST
*/

class ApiController extends Controller
{
    
  /* [Tipo   => GET.
      Función => getInstalaciones. 
      Retorna => un objeto "instalación" mediante una funcion JSON  hacia la aplicación movil REDIGLABUAP.
   ]*/
   public function getInstalaciones(){
         $instalacion = instalacion::
           select('Instalaciones.idInstalacion','Instalaciones.Nomenclatura','Academias.Academia')
         ->leftjoin('Academias','idAcademia','=','Academia_idAcademia')
         ->get();
       return response()->json($instalacion); 
    }

   /* [Tipo   => POST.
      Función => storeEquipo.
      Acción  => Crea y valida un equipo , sus caracteristicas e historial. 
      Retorna => Una funcion de tipo JSON con solicitud de respuesta hacia la aplicación movil REDIGLABUAP."
   ]*/ 
    public function storeEquipo(Request $request){

       $inventario = $request->get('NoInventario');
       $descripcion = $request->get('Descripcion');
       $fondo = $request->get('Fondo');             /*Obtiene los campos de la aplicación movil REDIGLABUAP*/
       $serie = $request->get('Serie');
       $organizacion = $request->get('Organizacion');
       $usuario = $request->get('Usuario');
       $nomenclatura = $request->get('Opcion');
     

      /*Valida si existe el NoInventario y la Categoria*/

       if (equipo::where('NoInventario', '=', $inventario)->exists()){
       	  return response()->json(["Mensaje"=>"La información QR ya ha sido registrada intente nuevamente!"]);
       }
       if (!tipo_equipo::where('Categoria', '=',$descripcion)->exists()){
       	  return response()->json(["Mensaje"=>"Informacion QR Invalida en Descripción No Existe"]);
       }
      
      $tipo = tipo_equipo::select('idTipo','CA')->where('Categoria','=',$descripcion)->first();
      $instalacion = instalacion::select('idInstalacion')->where('Nomenclatura','=',$nomenclatura)->first();

     /*Crea el objeto de equipo*/
      $equipo = new equipo([
        'NoInventario' => $inventario,
        'Serie' => $serie,
        'TipoEquipo_idTipo' => $tipo->idTipo,
        'Instalaciones_idInstalacion' => $instalacion->idInstalacion,
        'Disponible' => 0,
      ]);
      $equipo->save();
      
     if($tipo->CA==1){
        $caracteristicas_equipo = new caracteristicas_equipo([
        'Equipos_NoInventario' => $request->get('NoInventario'),
      ]);
      $caracteristicas_equipo->save(); /*Guarda la información hacia la tabla caracteristicas en la base de datos*/
     }


      $date = new \DateTime(); /*Obtenemos la hora y dia*/

     /*Crea el objeto de tipo historial*/
      $historial = new historial([
          'Equipos_NoInventario' => $inventario,
          'Alta' => $date->format('Y-m-d H:i:s'),
          'Estatus' => 1,
          'Registro' => 2,
      ]);
      $historial->save(); /*Guarda la información hacia la tabla historial en la base de datos*/

      return response()->json(["Mensaje"=>"El equipo se ha guardado exitosamente"]);
     }

}
