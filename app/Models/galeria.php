<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class galeria extends Model
{
	protected $table = 'Galeria'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idGaleria';  //LLave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.
    

     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idGaleria','Imagen','Equipos_NoInventario',
    ];

     //Consulta para obtener la galeria de todos los equipos.
     public function scopeEquipo($query){
           return $query->leftjoin('Equipos','NoInventario','=','Equipos_NoInventario');
     }
}
