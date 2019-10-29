<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad caracteristicas_equipo relacion 1:M.

class caracteristicas_equipo extends Model
{
    protected $table = 'CaracteristicasEquipo';  //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'Equipos_NoInventario'; //Llave primaria.
    public $timestamps = false;   //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    public $incrementing = false; //LLave primaria no autoincrementable.


    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
        'Equipos_NoInventario','NomenclaturaBuap','idProducto','SistemaOperativo','TipoSistema','MemoriaRam','Capacidad','Procesador'
    ];


}