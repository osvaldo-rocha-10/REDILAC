<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad instalacion relacion 1:M.
class instalacion extends Model
{
    protected $table = 'Instalaciones'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idInstalacion'; //LLave primaria.
    public $timestamps = false;   //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.

   //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idInstalacion','Nomenclatura','NoEdificio','Ubicacion','Academia_idAcademia','TipoInstalacion_idTipo'
    ];


     //Consulta de instalaciones por academia.
     public function scopeInstalacion_academia($query,$academia){    
         return $query->select('idInstalacion','Nomenclatura')->where('Academia_idAcademia',$academia)->orderBy('Nomenclatura');  
      }



}
