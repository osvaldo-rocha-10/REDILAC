<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /*URI que deberían ser accesibles mientras el modo de mantenimiento está habilitado*/
    protected $except = [
        //
    ];
}
