<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['admin.permission' => App\Http\Middleware\AdminRoutePermission::class]);
        
        // Check installation status (except installer routes)
        $middleware->web(append: [
            \App\Http\Middleware\CheckInstallation::class,
        ]);
        
        // Check license validity (blocks all access without valid license)
        $middleware->web(append: [
            \App\Http\Middleware\CheckLicense::class,
        ]);
        
        // CORS for API and storage
        $middleware->api(prepend: [
            \App\Http\Middleware\CorsMiddleware::class,
        ]);
        
        // CORS for web routes (for storage images)
        $middleware->web(append: [
            \App\Http\Middleware\CorsMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->reportable(function (\Throwable $e) {
            try {
                if (!app()->bound('db') || !\Illuminate\Support\Facades\Schema::hasTable('error_logs')) {
                    return;
                }
                $user = auth()->user();
                \App\Models\ErrorLog::create([
                    'type' => get_class($e),
                    'message' => mb_substr($e->getMessage(), 0, 500),
                    'file' => mb_substr($e->getFile(), 0, 500),
                    'line' => $e->getLine(),
                    'url' => request()->fullUrl() ? mb_substr(request()->fullUrl(), 0, 1000) : null,
                    'method' => request()->method(),
                    'trace' => mb_substr($e->getTraceAsString(), 0, 65535),
                    'context' => null,
                    'user_type' => $user ? get_class($user) : null,
                    'user_id' => $user?->getKey(),
                ]);
            } catch (\Throwable $ignored) {
            }
        });
    })->create();
