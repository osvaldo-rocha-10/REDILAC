<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad reporte  relacion 1:M.
class reporte extends Model
{
    protected $table = 'Reportes'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'Reporte'; //Llave primaria.
    public $incrementing = false;  //LLave primaria no autoincrementable.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    

     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'Reporte','Fecha','Tipo','Coordinador_idCoordinador'
    ];

   
}
