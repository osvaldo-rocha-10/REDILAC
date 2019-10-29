<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/*
1.-ControladorPrueba => ForgotPassword
*/

class ForgotPasswordController extends Controller
{
  

    use SendsPasswordResetEmails;

    //Redirección a login guest.
    public function __construct()
    {
        $this->middleware('guest');
    }
}
