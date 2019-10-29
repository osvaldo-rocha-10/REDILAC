<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad hitorial relacion 1:M.

class historial extends Model
{
    protected $table = 'Historial'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'Equipos_NoInventario'; //LLave primaria.
    public $incrementing = false;  //Llave primaria no autoincrementable.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.


    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'Equipos_NoInventario','Alta','Baja','Edita','Estatus','Registro',
    ];
}
