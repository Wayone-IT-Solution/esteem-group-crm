<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\UserAuthMiddleware;

Route::get('/',[AuthController::class,'index'])->name('admin.login');

// route for auth 
Route::prefix('auth')->group(function(){
    Route::post('validate-login-credentials',[AuthController::class,'validateCredentials'])->name('validate.login');
    Route::get('/logout',[AuthController::class,'logout'])->middleware(UserAuthMiddleware::class);
    
});

