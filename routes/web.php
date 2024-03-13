<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthCheckController;

Route::middleware('auth')->group(function () {
    Route::get('/helix', [HealthCheckController::class, 'index']);
});