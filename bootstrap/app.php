<?php

use App\Http\Middleware\SetLocaleMethod;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->alias([
            'set.locale' => \App\Http\Middleware\SetLocaleMethod::class,
            'check.cookie' => \App\Http\Middleware\CheckCookieConsent::class,
            'avoid.robots' => \App\Http\Middleware\PreventsRobotsIndexing::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
