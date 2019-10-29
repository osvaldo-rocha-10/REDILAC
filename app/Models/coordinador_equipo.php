<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

//entidad coordinador equipo relacion M:M.
class coordinador_equipo extends Model
{
    protected $table = 'CoordinadorEquipo'; //Nombre de la tabla en la base de datos.
    protected $primaryKey =  'Equipos_NoInventario'; //Lave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    
    
    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'Equipos_NoInventario','Coordinador_idCoordinador'
    ];

   //Consulta para obtener información de Equipos,TipoEquipo e Instalaciones.
    public function scopeEquipo($query){    

    	 return $query->leftjoin('Equipos','NoInventario','=','Equipos_NoInventario')
                      ->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                      ->leftjoin('Instalaciones','idInstalacion','=','Equipos.Instalaciones_idInstalacion');
                        

    }
}
