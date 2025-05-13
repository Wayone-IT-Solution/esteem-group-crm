<?php


use App\Http\Controllers\AlluserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/users')->group(function () {
    Route::get('/', [AlluserController::class, 'index'])->name('company.Alluser');
    Route::post('/', [AlluserController::class, 'store'])->name('company.Alluser.store');
    Route::get('/create', [AlluserController::class, 'create'])->name('company.Alluser.create');
    Route::get('/{id}/edit', [AlluserController::class, 'edit'])->name('company.Alluser.edit');
    Route::put('/update/{id}', [AlluserController::class, 'update'])->name('company.Alluser.update');
    Route::delete('/{id}', [AlluserController::class, 'destroy'])->name('company.Alluser.destroy');
    Route::get('roles/{company_id}', [AlluserController::class, 'getRoles'])->name('company.getRoles');
    Route::get('departments/{company_id}', [AlluserController::class, 'getDepartmentsByCompany'])->name('company.getDepartmentsByCompany');


});