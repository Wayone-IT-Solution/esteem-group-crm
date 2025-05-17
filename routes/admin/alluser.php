<?php


use App\Http\Controllers\AlluserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/users')->group(function () {
    Route::get('/', [AlluserController::class, 'index'])->name('admin.users.all');
    Route::get('/company/{id}', [AlluserController::class, 'getuser']);
    Route::post('/', [AlluserController::class, 'store'])->name('company.Alluser.store');
    Route::get('/create', [AlluserController::class, 'create'])->name('admin.users.add');
    Route::get('/{id}/edit', [AlluserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/update/{id}', [AlluserController::class, 'update'])->name('admin.user.update');
    Route::delete('/{id}', [AlluserController::class, 'destroy'])->name('company.Alluser.destroy');
    Route::get('roles/{company_id}', [AlluserController::class, 'getRoles'])->name('company.getRoles');
    Route::get('departments/{company_id}', [AlluserController::class, 'getDepartmentsByCompany'])->name('company.getDepartmentsByCompany');
    Route::post('/commandelete',[AlluserController::class, 'commandelete']);
    Route::post('/filter',[AlluserController::class, 'filter'])->name('admin.users.filter');

});