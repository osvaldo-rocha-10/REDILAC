<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*Modelos*/
use App\Models\galeria;

/* 1.-Controlador => Formato*/
 
/* 2.-Tipo:CRUD.*/

/*
   3.-Funciones => 
    [ Index($NoInventario) => GET,
      EsImagen($file) => PRIVATE,
      Subir(Request $request, $NoInventario) => PUT,
      Eliminar(Request $request) => POST, 
    ]
*/

class GaleriaController extends Controller
{
       /*Middelware login.*/
     public function __construct(){
        $this->middleware('auth');
     }

  
    /*[Tipo    => GET.
      Función  => index.
      Retorna  => Los  objetos "galeria","NoInventario" hacia la vista "coordinador_docente/Galeria."
    ]*/
    public function Index($NoInventario){

      /*Consulta para obtener la galeria de un equipo mediante su NoInventario*/
      $galeria = galeria::equipo()->where('Equipos_NoInventario',$NoInventario)->get();

      return view('coordinador_docente.Galeria',['galeria'=>$galeria,'NoInventario'=>$NoInventario]);
    }

   /*[Tipo     => private.
      Función  => EsImagen.
      Acción   => Valida la extensión de un file.
      Retorna  => TRUE/FALSE.
    ]*/
    private function EsImagen($file){

       /*Obtiene la extesión de un file*/
       $imagen = explode(".", $file->getClientOriginalName()); 

       if($imagen[1]=="jpg" || $imagen[1]=="png" || $imagen[1]=="jpeg" || $imagen[1]=="gif" || $imagen[1]=="raw")
       	        return true;
       else 
       	        return  false;
    }


   
   /*[Tipo   => PUT.
      Función => Subir.
      Acción  => Crea y valida una imagen de galeria.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la vista anterior".
   ]*/

    public function Subir(Request $request, $NoInventario){ 


       if ($request->hasFile('image')){

             $file = $request->file('image');

             if(count($file) < 10){
                   foreach ($file as  $files){
             	        if(!$this->EsImagen($files))
                            return back()->with('error', 'Extensión invalida verifique.'); 
                   }

                   foreach ($file as  $files){
             	       $nombre_imagen = $files->getClientOriginalName();
                       $files->move(public_path().'/Almacenamiento/GaleriaEquipos/',$nombre_imagen);
                      /*Crea el objeto galeria*/
                       $galeria = new  galeria([
                           'Imagen' => $nombre_imagen,
                           'Equipos_NoInventario' => $NoInventario,
                       ]);
                       $galeria->save(); /*Guarda la informacion hacia la tabla galeria*/
                   }

                  return back()->with('success', 'La operación se ha ejecutado con exito.'); 

             }else
             	  return back()->with('error', 'Limite excedido'); 
       }else 
       	   return back()->with('warning', 'Seleccione por lo menos una imagen'); 

    }

   /*[Tipo   => POST.
      Función => Eliminar.
      Acción  => Elimina un conjunto de imagenes de una galeria.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la vista anterior".
   ]*/
    public function Eliminar(Request $request){

    	if(!is_null($request->get('galeria')))
              $galeria = $request->get('galeria');
        else
            return back()->with('warning', 'Seleccione por lo menos una casilla de galeria.'); 
 

         foreach ($galeria as  $galerias){ 
                    $imagen = galeria::find($galerias);
                     /*Obtenemos archivo de la ruta*/
                    $archivo_imagen = public_path().'/Almacenamiento/GaleriaEquipos/'.$imagen->Imagen;

                    if(file_exists($archivo_imagen))
                             unlink($archivo_imagen);  /*Elimina el  archivo de la ruta Almacenamiento/GaleriaEquipos/...*/

                    $imagen->delete();  /*Elimina una imagen en la tabla Galeria*/
          }

          return back()->with('success', 'La operación se ha ejecutado con exito.'); 
     
        
    }

    
    
}
