<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad tipo_equipo relacion 1:M.
class tipo_equipo extends Model
{
    protected $table = 'TipoEquipo'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idTipo'; //LLave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.

    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idTipo','Categoria','CA'
    ];
    
    //Consulta por nombre en base a su id de categoria.
    public function scopeNombre($query,$id){   
         return $query->select('Categoria')->where('idTipo',$id);
    }

    //Consulta por tipo de categoria en base a su area.
    public function scopeCategoria_area($query,$_estatus,$_academia){ 
        $this->estatus=$_estatus;
        $this->academia = $_academia;
        return $query->whereIn('idTipo',function($query){
                                              $query->select('Equipos.TipoEquipo_idTipo')
                                              ->from('Equipos')
                                              ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                              ->where('Historial.Estatus',$this->estatus)
                                              ->whereIN('Equipos.Instalaciones_idInstalacion', function($query2){
                                                 $query2->select('Instalaciones.idInstalacion')
                                                ->from('Instalaciones')
                                                ->where('Instalaciones.Academia_idAcademia',$this->academia);
                                               }
                                              );
                                      }
           );
    }

    //Consulta de tipo de categoria en base a su instalación.
    public function scopeCategoria_instalacion($query,$estatus,$instalacion){  
               
               return $query->select('TipoEquipo.Categoria','TipoEquipo.idTipo')
                       ->leftjoin('Equipos','Equipos.TipoEquipo_idTipo','=','TipoEquipo.idTipo')
                       ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')   
                       ->where('Equipos.Instalaciones_idInstalacion',$instalacion)
                       ->where('Historial.Estatus',$estatus)
                       ->groupBy('TipoEquipo.Categoria','TipoEquipo.idTipo');
    }


}
