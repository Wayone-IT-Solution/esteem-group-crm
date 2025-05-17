<?php

use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/request')->group(function () {
    // Admin Department routes
    Route::get('/', [RequestController::class, 'index'])->name('admin.request.all');
    Route::get('/create', [RequestController::class, 'create'])->name('request.create');
    Route::post('/', [RequestController::class, 'store'])->name('request.store');
    Route::get('/{request}/edit', [RequestController::class, 'edit'])->name('request.edit');
    Route::put('/{request}', [RequestController::class, 'update'])->name('request.update');
    Route::post('/filter', [RequestController::class, 'filter'])->name('admin.request.filter');
});
