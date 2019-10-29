<?php

namespace App\Http\Controllers\Auth;

//Librerias.
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

//Controlador Login
class LoginController extends Controller
{
    

    use AuthenticatesUsers;


    protected $redirectTo = '/home';

    //Protección de datos inicio/cierre sessión. 
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); //Rederigir a login.
    }
   
    public function username(){
        return 'idCoordinador';
    }

    //Función redirigir vista dependiendo del tipo de usuario.
    public function redirectTo()
    {

      if(Auth::user()->TipoUsuario == 1)
             return '/home/administrador';
      else if(Auth::user()->TipoUsuario == 2)
             return '/home/area';
       else if(Auth::user()->TipoUsuario == 3)
             return '/home/docente';
    }
}
