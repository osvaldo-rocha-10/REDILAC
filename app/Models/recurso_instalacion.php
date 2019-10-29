<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad recurso_instalación relacion M:M.
class recurso_instalacion extends Model
{
     protected $table = 'RecursoInstalacion'; //Nombre de la tabla en la base de datos.
     protected $primaryKey = 'RecursosDigitales_idRecursoDigital'; //Llave primaria.
     public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.

     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
        'RecursosDigitales_idRecursoDigital','Instalacion_idInstalacion',
     ];

    //Consulta para obtener la instalación que pertence a un recurso digital.
     public function scopeInstalacion($query,$id){

      return $query
               ->select('Instalaciones.Nomenclatura as ins')
               ->leftjoin('Instalaciones','idInstalacion','=','Instalacion_idInstalacion')
               ->where('RecursosDigitales_idRecursoDigital',$id);

     }

    
}
