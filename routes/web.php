<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);


// auth routes
require __DIR__ . '/auth.php';

// admin routes
require __DIR__.'/admin/dashboard.php';

