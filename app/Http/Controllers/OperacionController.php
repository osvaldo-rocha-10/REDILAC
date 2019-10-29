<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class OperacionController extends Controller
{
    
        public function __construct()
        {
            $this->middleware('auth');
        } 


       public function Operacion()
       {

       	   if(Auth::user()->TipoUsuario==1)
                 return view('admin.Operacion');
       	   else if(Auth::user()->TipoUsuario==2)
                return view('coordinador_area.Operacion');
           else if(Auth::user()->TipoUsuario==3)
                 return view('coordinador_docente.Operacion');
       }
    
}
