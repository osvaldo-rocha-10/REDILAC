<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class RegisterController extends Controller
{
    
    use RegistersUsers;

    
    protected $redirectTo = '/home';

    //proteccion de datos middleware de inicio/cierre sessión.   
    public function __construct()
    {
        $this->middleware('guest');
    }

   
    //Función de reglas crear coordinador.
    protected function validator(array $data)
    {
        return Validator::make($data, [
           /* 'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:8','unique:users'],
            'image' =>['string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],*/
            'idUsuario' =>['required'],
            'nombre' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            

        ]);
    }

   //Función crear coordinador.
    protected function create(array $data)
    {
        return User::create([
            /*'name' => $data['name'],
            'username' => $data['username'],
            'image' => $data['image'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),*/
            'idUsuario' => $data['idUsuario'],
            'nombre' => $data['nombre'],
            'password' => Hash::make($data['password'])
            ,

        ]);
    }
    
  //Función de prueba para el envio de datos de tipo POST.
   public function store(Request $request)
   {
        return $request;
    }

}
