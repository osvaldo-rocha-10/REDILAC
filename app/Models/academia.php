<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


 //Entidad academia relacion 1:M.

class academia extends Model
{
    protected $table = 'Academias'; //Nombre de la tabla en la base de datos.
    protected $primaryKey = 'idAcademia'; //LLave primaria.
    public $timestamps = false;  //No contiene los metodos por defecto created_at && updated_at en nuestra tabla.

     //Atributos que seran utilizados y modificados para los metodos CRUD u otro metodo desde su controlador.
     protected $fillable = [
          'idAcademia','Academia' 
     ];

    
      public function scopeNombre($query,$id){    //Consulta por id para verificar a la academia a la que pertence.
      	                                         
         return $query->select('Academia')->where('idAcademia',$id);
      }

       
      
}
