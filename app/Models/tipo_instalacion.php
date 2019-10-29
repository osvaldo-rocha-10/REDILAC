<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad tipo_instalacion relacion 1:M.

class tipo_instalacion extends Model
{
    protected $table = 'TipoInstalacion'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idTipo'; //LLave primaria.
    public $timestamps = false;  //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    
    //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idTipo','Categoria',
    ];
}
