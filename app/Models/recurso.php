<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

//Entidad recurso relacion 1:M.

class recurso extends Model
{
    protected $table = 'RecursosDigitales'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idRecursoDigital'; //LLave primaria.
    public $timestamps = false; //No contiene los metodos por defecto created_at && updated_at en nuestra base de datos.

  //Atributos que seran utilizados y modificados para el CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idRecursoDigital','DescripcionRecurso','RecursoDigital','Image_idImage','TipoRecurso_idTipoRecurso'
    ];

    //Consulta para obtener los recursos que pertencen a una area.
    public function scopeArea($query){

    return $query
        ->select('RecursosDigitales.idRecursoDigital as id',
        	     'RecursosDigitales.RecursoDigital as recurso',
        	     'TipoRecurso.Categoria as categoria',
        	     'Image.Imagen  as icono',
        	     'RecursosDigitales.DescripcionRecurso  as descripcion'
        	    )
        ->leftjoin('TipoRecurso','idTipoRecurso','=','TipoRecurso_idTipoRecurso')
        ->leftjoin('Image','idImage','=','Image_idImage')

        ->whereIn('idRecursoDigital',
                   function ($query) {
                           $query->select('RecursoInstalacion.RecursosDigitales_idRecursoDigital')
                           ->from('RecursoInstalacion')
                           ->whereIn('RecursoInstalacion.Instalacion_idInstalacion',
                               function ($query) {
                                 $query->select('Instalaciones.idInstalacion')
                                 ->from('Instalaciones')
                               ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia);
                              });
                    });
     }

    //Consulta para obtener todos los iconos relacionados a su recurso digital.
     public function scopeImage($query){
      return $query->leftjoin('Image','idImage','=','Image_idImage');
     }

     
    //Consulta para obtener los recursos pertenecientes a su instalación.
    public function scopeTotal_recursos($query,$id){
         $this->instalacion = $id;

         return $query->whereIn('idRecursoDigital',function ($query) {
                                 $query->select('RecursoInstalacion.RecursosDigitales_idRecursoDigital')
                                 ->from('RecursoInstalacion')
                                 ->where('RecursoInstalacion.Instalacion_idInstalacion',$this->instalacion);
                             });
     }

     
     


   


}
