<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

/*
1.-Controlador Prueba => Verificacion de emails

*/
class VerificationController extends Controller
{
    

    use VerifiesEmails;

  
    protected $redirectTo = '/home';

     
    //Restricción en login , verificación en  envio de email y  solicitud de respuesta.
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
