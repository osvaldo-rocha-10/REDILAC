<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad equipo relacion 1:M.

class equipo extends Model
{
    protected $table = 'Equipos'; //Nombre de la tabla en la base de datos.
    protected $primaryKey = 'NoInventario';  //Llave primaria.
    public $timestamps = false;  //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    

    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
         'NoInventario','Serie','Modelo','TipoAdquisicion','Observacion1','Observacion2','Disponible','TipoEquipo_idTipo','Instalaciones_idInstalacion'
    ];

    //Consulta equipos por área.
    public function scopeArea($query,$estatus,$academia){   
          $this->_academia = $academia;

          return $query  ->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                         ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                         ->where('Historial.Estatus',$estatus)
                          ->whereIn('Instalaciones_idInstalacion',function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->_academia);
                          });
      }

     //Consulta equipos por área en base a su categoria.
      public function scopeArea_categoria($query,$categoria,$estatus,$academia){  
      	  $this->_academia = $academia;

          return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                ->where('Equipos.TipoEquipo_idTipo',$categoria)
                                ->where('Historial.Estatus',$estatus)
                                ->whereIn('Instalaciones_idInstalacion',
                                        function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->_academia);
                                          }

           );
      }
      //Consulta de equipos por área en base a la busqueda.
      public function scopeArea_busqueda($query,$estatus,$busqueda,$academia){  
      	$this->_academia = $academia;

        return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                ->where('NoInventario', 'LIKE', "%$busqueda%")
                                ->where('Historial.Estatus',$estatus)
                                ->whereIn('Instalaciones_idInstalacion',
                                        function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->_academia);
                                          });
      }

      //Consulta de equipos por área en base a la categoria de busqueda.
      public function scopeArea_busqueda_categoria($query,$estatus,$categoria,$busqueda,$academia){ 
         $this->_academia = $academia;                                                                       
                                                                                                 
         return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                ->where('NoInventario', 'LIKE', "%$busqueda%")
                                ->where('Equipos.TipoEquipo_idTipo',$categoria)
                                ->where('Historial.Estatus',$estatus)
                                ->whereIn('Instalaciones_idInstalacion',
                                        function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->_academia);
                                          }

           );
      }
      
       //Consulta equipos por instalación.
      public function scopeInstalacion($query,$estatus,$instalacion){   

          return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                      ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')        
                      ->where('Equipos.Instalaciones_idInstalacion',$instalacion)
                      ->where('Historial.Estatus',$estatus);
      }

     //Consulta equipos por área en base a su categoria.
      public function scopeInstalacion_categoria($query,$categoria,$estatus,$instalacion){   
        
        return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                            ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                            ->where('Equipos.Instalaciones_idInstalacion',$instalacion)
                            ->where('Equipos.TipoEquipo_idTipo',$categoria)
                             ->where('Historial.Estatus',$estatus);
      }
  
      //consulta de equipos por instalacion en base a su busqueda.
      public function scopeInstalacion_busqueda($query,$estatus,$busqueda,$instalacion){  
          
              return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                      ->where('NoInventario', 'LIKE', "%$busqueda%")
                      ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')        
                      ->where('Equipos.Instalaciones_idInstalacion',$instalacion)
                      ->where('Historial.Estatus',$estatus);
      
      }
      
      //consulta de equipos por instalacion en en base a su categoria.
      public function scopeInstalacion_busqueda_categoria($query,$estatus,$categoria,$busqueda,$instalacion){
           return $query->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')                     
                            ->where('NoInventario', 'LIKE', "%$busqueda%")
                            ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                            ->where('Equipos.Instalaciones_idInstalacion',$instalacion)
                            ->where('Equipos.TipoEquipo_idTipo',$categoria)
                             ->where('Historial.Estatus',$estatus);
      }

}
