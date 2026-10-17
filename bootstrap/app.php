<?php

use App\Http\Middleware\CheckIfAdmin;
use App\Http\Middleware\CheckIfVendor;
use App\Http\Middleware\CheckIfVendorStore;
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
            'admin' => CheckIfAdmin::class,
            'vendor' => CheckIfVendor::class,
            'vendorStore' => CheckIfVendorStore::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
