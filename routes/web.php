<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AlluserController;
use App\Http\Controllers\leadController;

// Auth routes
Route::get('/', [AuthController::class, 'index']);

// Load auth routes from 'auth.php'
require __DIR__ . '/auth.php';

// Admin routes
require __DIR__.'/admin/dashboard.php';
require __DIR__.'/admin/company.php';
require __DIR__.'/admin/roles.php';
require __DIR__.'/admin/department.php';

// Admin Company routes

// Admin All Users routes
Route::get('/admin/users', [AlluserController::class, 'index'])->name('admin.all_users');  // View all users
Route::get('/admin/users/create', [AlluserController::class, 'create'])->name('users.create');  // Create user form
Route::post('/admin/users', [AlluserController::class, 'store'])->name('users.store');  // Store user
Route::get('/admin/users/{user}/edit', [AlluserController::class, 'edit'])->name('users.edit');  // Edit user form
Route::put('/admin/users/{user}', [AlluserController::class, 'update'])->name('users.update');  // Update user
Route::delete('/admin/users/{user}', [AlluserController::class, 'destroy'])->name('users.destroy');  // Delete user
Route::get('/company/{id}/roles', [AlluserController::class, 'getRoles']);

Route::get('/company/{id}/departments', [AlluserController::class, 'getDepartmentsByCompany']);

Route::get('/admin/leads', [LeadController::class, 'showallleads'])->name('all-leads');

Route::get('/admin/leads/add', [LeadController::class, 'addleads'])->name('add-leads');


