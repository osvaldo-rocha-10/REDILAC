<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad formato relacion 1:M.
class formato extends Model
{
    protected $table = 'Formatos'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idFormatos';  //Llave primaria.
    public $timestamps = false;   //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.

     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
        'idFormatos','Formato','Fecha','Academias_idAcademia'
     ];
}
