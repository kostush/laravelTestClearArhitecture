<?php

use App\Http\Middleware\Owner;
use Illuminate\Support\Facades\Route;
use Src\UI\Http\Controllers\HealthCheckController;

Route::prefix('v1')->group (function() {
    Route::get('/', function(){
        return "LeravelTest";
    });
    Route::get('/health-check', [HealthCheckController::class, 'check'])
        ->middleware([
            Owner::class,
            'throttle:health-check'
        ]);
});

