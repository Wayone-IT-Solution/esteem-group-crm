<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;

// Auth routes
Route::get('/', [AuthController::class, 'index']);

// Load auth routes from 'auth.php'
require __DIR__ . '/auth.php';

// Admin routes
require __DIR__.'/admin/dashboard.php';
require __DIR__.'/admin/company.php';

// Admin Company routes
Route::get('/admin/companies', [CompanyController::class, 'index'])->name('admin.companies');
Route::get('/admin/companies/create', [CompanyController::class, 'create'])->name('company.create');
Route::post('/admin/companies', [CompanyController::class, 'store'])->name('company.store');
Route::get('/admin/companies/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::put('/admin/companies/{id}', [CompanyController::class, 'update'])->name('company.update');
Route::delete('/admin/companies/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

// Admin Role routes
Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles');  // View all roles
Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('role.create');  // Create role form
Route::post('/admin/roles', [RoleController::class, 'store'])->name('role.store');  // Store role
Route::get('/admin/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');  // Edit role form
Route::put('/admin/roles/{role}', [RoleController::class, 'update'])->name('role.update');  // Update role
Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])->name('role.destroy');  // Delete role
// admin all deaprtment
use App\Http\Controllers\DepartmentController;

// Admin Department routes
// Admin Department routes
Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('admin.department');
Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/admin/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/admin/departments/{department}', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
