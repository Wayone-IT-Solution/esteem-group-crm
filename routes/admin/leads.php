<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAuthMiddleware;

Route::middleware([UserAuthMiddleware::class])->prefix('admin/leads')->group(function () {
    // Admin Department routes
    Route::get('/', [LeadController::class, 'index'])->name('all-leads');
    Route::get('/create', [LeadController::class, 'create'])->name('admin.leads.create');
    Route::post('/', [LeadController::class, 'store'])->name('leads.store');
    Route::get('/{lead}/edit', [LeadController::class, 'edit'])->name('admin.leads.edit');
    Route::put('/update/{lead}', [LeadController::class, 'update'])->name('leads.update');
    Route::post('/filter', [LeadController::class, 'filter'])->name('admin.leads.filter');
    Route::post('/canvas', [LeadController::class, 'canvas'])->name('admin.leads.canvas');
    Route::post('/description', [LeadController::class, 'description'])->name('leads.update.description');
    Route::get('/{company_id}/{status}', [LeadController::class, 'getleads']);
    Route::get('/company/all/{company_id}', [LeadController::class, 'getallcompanyleads']);
    Route::get('/company/today/{company_id}', [LeadController::class, 'todayleads']);
    Route::post('/leads/import', [LeadController::class, 'import'])->name('admin.leads.import');
    Route::get('/secondconnection', [LeadController::class, 'secondconnection']);
    Route::post('/update-status', [LeadController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/finance-filter', [LeadController::class, 'financeFilter'])->name('admin.finance.filter');
    Route::post('/edit-update-status', [LeadController::class, 'editUpdateStatus'])->name('editUpdateStatus');



    
});
