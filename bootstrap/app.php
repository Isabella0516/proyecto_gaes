<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Si no necesitas el middleware 'role', puedes eliminar esta sección
        // o dejarla vacía si no hay middlewares personalizados que registrar.
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();