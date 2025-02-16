<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function() {
            $namespace = 'App\Http\Controllers';

            Route::middleware(['web'])
                ->as('site.')
                ->namespace($namespace.'\Site')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web'])
                ->namespace($namespace . "\Auth")
                ->prefix('auth')
                ->group(base_path("routes/auth.php"));

            Route::middleware(['web', 'auth'])
                ->prefix('dashboard')
                ->as('dashboard.')
                ->namespace($namespace.'\Admin')
                ->group(base_path('routes/dashboard.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
