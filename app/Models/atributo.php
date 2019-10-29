<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Entidad atributo relacion 1:M.

class atributo extends Model
{
    protected $table = 'AtributoCompetencia'; //Nombre de la tabla en la base de datos.
    protected $primaryKey = 'NumeroAtributo';  //LLave primaria.
    public $timestamps = false;   //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.


     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
       'NumeroAtributo','DescripcionAtributo','DescripcionCompetencia_NumeroCompetencia', }

    ];

}
