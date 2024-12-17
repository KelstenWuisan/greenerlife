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
if (!is_dir('/tmp/bootstrap/cache')) {
    mkdir('/tmp/bootstrap/cache', 0755, true);
}
$app->useStoragePath('/tmp');

// Force Laravel to use /tmp/bootstrap/cache explicitly
$config = $app->make('config');
$config->set('view.compiled', '/tmp/views');
$config->set('cache.stores.file.path', '/tmp/framework/cache');
$config->set('session.files', '/tmp/framework/sessions');
$config->set('app.manifest', '/tmp/bootstrap/cache');

return $app;
