<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad tipo_recurso relacion 1:M.
class tipo_recurso extends Model
{
    protected $table = 'TipoRecurso'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idTipoRecurso'; //LLave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    
     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idTipoRecurso','Categoria',
    ];
}
