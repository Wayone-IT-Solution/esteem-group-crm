<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('admin.companies');
    Route::post('/', [CompanyController::class, 'store'])->name('company.store');
    Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
    Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/get-statuses/{id}', [CompanyController::class, 'status']);
});
