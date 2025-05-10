<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('admin.companies');
});
