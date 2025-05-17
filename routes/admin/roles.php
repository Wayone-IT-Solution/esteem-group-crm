<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/roles')->group(function () {
Route::get('/', [RoleController::class, 'index'])->name('admin.roles');  // View all roles
Route::get('/create', [RoleController::class, 'create'])->name('role.create');  // Create role form
Route::post('/', [RoleController::class, 'store'])->name('role.store');  // Store role
Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');  // Edit role form
Route::put('/{role}', [RoleController::class, 'update'])->name('role.update');  // Update role
Route::delete('/{role}', [RoleController::class, 'destroy'])->name('role.destroy');  // Delete role
Route::post('filter',[RoleController::class,'filter']   )->name('admin.roles.filter');

});
