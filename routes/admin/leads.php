<?php

use App\Http\Controllers\LeadController;
use App\Http\Middleware\UserAuthMiddleware;
use Illuminate\Support\Facades\Route;

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
    Route::get('/{company_id}/Enquiry/all', [LeadController::class, 'getleadsAll']);
    Route::get('/company/all/{company_id}', [LeadController::class, 'getallcompanyleads']);
    Route::post('/leads/import', [LeadController::class, 'import'])->name('admin.leads.import');
    Route::get('/secondconnection', [LeadController::class, 'secondconnection']);
    Route::post('/update-status', [LeadController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/finance-filter', [LeadController::class, 'financeFilter'])->name('admin.finance.filter');
    Route::post('/edit-update-status', [LeadController::class, 'updateStatus'])->name('editUpdateStatus');
    Route::get('7/Lead/today', [LeadController::class, 'todaysection'])->name('editUpdateStatus');
    Route::get('loan/{id}/comments', [LeadController::class, 'loanComments']);
    Route::get('loan/{loan}/edit', [LeadController::class, 'editLeads'])->name('admin.leads.finance.edit');
    Route::put('/loan-applications/{id}', [LeadController::class, 'updateLoan'])->name('loan.update');
    Route::post('/filter-enquires', [LeadController::class, 'filterEnquires'])->name('admin.leads.filterEnquires');
    Route::get('/enquiry/today/{company_id}', [LeadController::class, 'todayleads']);
    Route::get('/company/today/{company_id}', [LeadController::class, 'getcompanytodayleads']);
    Route::get('/{company_id}/Enquiry/database', [LeadController::class, 'getNullEnquires']);
    Route::get('/{company_id}/Enquiry/social-media', [LeadController::class, 'getSMEnquires']);





});
