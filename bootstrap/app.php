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

// Fix: Redirect writable paths to `/tmp` directory for Vercel compatibility
$app->useStoragePath('/tmp');

// Ensure directories exist
if (!is_dir('/tmp/bootstrap/cache')) {
    mkdir('/tmp/bootstrap/cache', 0755, true);
}
if (!is_dir('/tmp/framework/sessions')) {
    mkdir('/tmp/framework/sessions', 0755, true);
}
if (!is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0755, true);
}

return $app;
