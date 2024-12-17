<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// Force writable paths for Vercel
$writableCachePath = '/tmp/bootstrap/cache';

if (!is_dir($writableCachePath)) {
    mkdir($writableCachePath, 0755, true);
}

$app->useStoragePath('/tmp');

return $app;
