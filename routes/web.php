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
require __DIR__.'/admin/status.php';
require __DIR__.'/admin/alluser.php';
require __DIR__.'/admin/request.php';
require __DIR__.'/admin/leads.php';



// Admin Company routes


Route::get('/company/{id}/roles', [AlluserController::class, 'getRoles']);

Route::get('/company/{id}/departments', [AlluserController::class, 'getDepartmentsByCompany']);




