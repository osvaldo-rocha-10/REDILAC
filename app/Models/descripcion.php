<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Entidad descripcion relacion 1:M.

class descripcion extends Model
{
    protected $table = 'DescripcionCompetencia'; //Nombre de la tabla en la base de datos.
    protected $primaryKey = 'NumeroCompetencia';  //Llave primaria.
    public $timestamps = false;   //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.
    public $incrementing = false;  //Llave primaria no autoincrementable.

    //Atributos que seran utilizados Y modificados para el CRUD u otro metodo desde su controlador.
     protected $fillable = [
        'NumeroCompetencia','DescripcionCompetencia','TipoCompetencia_idCompetencia','Disciplina'
    ];
     
    //Atributos especiales para realizar una operación especifica.
    protected $casts = [ 'NumeroCompetencia' => 'decimal:1']; //Atributo NumeroCompetencia con decimal en 1 de izquierda a derecha.


    // Consulta para obtener todas las categorias de su respectiva competencia.
    public function scopeCategoria($query){  
    	return $query->leftjoin('TipoCompetencia','idCompetencia','=','TipoCompetencia_idCompetencia');
    }
    

   //Consulta para obtener las competencias en base a su recurso digital.
    public function scopeCompetencias($query,$_recurso){ 
       $this->recurso = $_recurso;

      return $query->whereIn('NumeroCompetencia',function ($query) {
                                 $query->select('DescripcionCompetencia_NumeroCompetencia')
                                 ->from('RecursoCompetencia')
                                 ->where('RecursoCompetencia.RecursosDigitales_idRecursoDigital',$this->recurso);
                             });
    }


}
