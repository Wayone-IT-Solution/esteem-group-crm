<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\UserAuthMiddleware;

// Admin Status routes


Route::middleware(['auth'])->prefix('admin/status')->group(function () {
    Route::get('/', [StatusController::class, 'index'])->name('admin.status.index');
    Route::get('/create', [StatusController::class, 'create'])->name('status.create');
    Route::post('/', [StatusController::class, 'store'])->name('status.store');
    Route::get('/{status}/edit', [StatusController::class, 'edit'])->name('status.edit');
    Route::put('/{status}', [StatusController::class, 'update'])->name('status.update');
    Route::delete('/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
});
