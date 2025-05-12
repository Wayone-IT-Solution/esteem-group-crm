<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/departments')->group(function () {
    // Admin Department routes
    Route::get('/', [DepartmentController::class, 'index'])->name('admin.department');
    Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/{department}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
});
