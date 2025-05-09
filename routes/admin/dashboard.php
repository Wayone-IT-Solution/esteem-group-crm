<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/documenation', [DashboardController::class, 'documentation'])->name('admin.documentation');
    Route::post('/commandelete', [DashboardController::class, 'commanDelete']);
});
