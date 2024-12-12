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
        // Register global middleware
        $middleware->web([
            \Illuminate\Http\Middleware\HandleCors::class,
            // \App\Http\Middleware\VerifyCsrfToken::class,
        ]);

        // Register middleware aliases
        $middleware->alias([
            // 'auth' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'technician' => \App\Http\Middleware\TechnicianMiddleware::class,
            'requester' => \App\Http\Middleware\RequesterMiddleware::class,
            // Add other middleware aliases here
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();