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
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->reportable(function (\Throwable $e) {
            file_put_contents('php://stderr', "LARAVEL CRASH: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n");
        });
    })->create();

if (getenv('VERCEL') !== false || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
    
    // Ensure all required storage directories exist in the Vercel /tmp filesystem
    $directories = [
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/logs',
        '/tmp/storage/app/public',
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
}

return $app;
