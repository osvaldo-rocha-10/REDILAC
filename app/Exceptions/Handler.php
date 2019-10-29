<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /*lista de los tipos de excepción que no se informan*/
    protected $dontReport = [
        //
    ];

    /*lista de las entradas que nunca se muestran para excepciones de validación*/

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /* Informar o registrar una excepción */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /*Representa una excepción a una respuesta HTTP*/
     
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
