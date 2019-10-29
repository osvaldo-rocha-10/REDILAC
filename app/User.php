<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

//Entidad User hereda del metodo autoentificable. relacion 1:M

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'Coordinador'; //Nombre de la tabla en nuestra base de datos.
    protected $primaryKey = 'idCoordinador';  //LLave primaria.
    public $incrementing = false; //LLave primaria no autoincrementable.


    //Atributos que seran utilizados y modificados para los metodos CRUD u otro metodo desde su controlador.
    protected $fillable = [
        'idCoordinador','Nombre','password','Icono','TipoUsuario','Academias_idAcademia'
    ];

    
   //Atributos ocultos y con un token de referencia por clave.
    protected $hidden = [
        'password', 'remember_token',
    ];

}
