<?php

namespace App\Http\Middleware;

use Closure;

class CoordinadorAreaMiddleware
{
   
    public function handle($request, Closure $next)
    {
         if (\Auth::user()->TipoUsuario == 2) {
               return $next($request);
        }

     abort(403,"Autorizacion Invalida no cuenta con los permisos necesarios para ver este contenido.");
    }
}
