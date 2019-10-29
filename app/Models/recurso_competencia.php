<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//entidad recurso_competencia relacion M:M.

class recurso_competencia extends Model
{
    protected $table = 'RecursoCompetencia'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'RecursosDigitales_idRecursoDigital'; //LLave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.

     //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
        'RecursosDigitales_idRecursoDigital','DescripcionCompetencia_NumeroCompetencia',
     ];

     //Atributos especiales para realizar una operación especifica.
    protected $casts = ['DescripcionCompetencia_NumeroCompetencia' => 'decimal:1']; 
    //Atributo DescripcionCompetencia_NumeroCompetencia con decimal en 1 de izquierda a derecha.

}
