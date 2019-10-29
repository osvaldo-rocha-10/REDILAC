<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/*
1.-Controlador Prueba => ResetPassword

*/
class ResetPasswordController extends Controller
{
    use ResetsPasswords; 


    protected $redirectTo = '/home';

    // Redirección a inicio de session
    public function __construct()
    {
        $this->middleware('guest');
    }
}
