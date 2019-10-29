<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad marca relacion 1:M.

class marca extends Model
{
    protected $table = 'Marca'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idMarca'; //Llave primaria.
    public $timestamps = false;  //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.

    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idMarca','Marca',
    ];
}
