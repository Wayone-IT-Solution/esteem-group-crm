<?php

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware([UserAuthMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/documenation', [DashboardController::class, 'documentation'])->name('admin.documentation');
    Route::post('/commandelete', [DashboardController::class, 'commanDelete']);
    Route::get('/profile/update-password', [DashboardController::class, 'show'])->name('profile.show');
    Route::post('/profile/password', [DashboardController::class, 'updatePassword'])->name('profile.password.update');

});
