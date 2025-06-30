<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;


Route::post("/v1/webhook", [ApiController::class, 'webhook']);
Route::post("/v1/webhook/we-care-auto-repairs-add-pannel-bt", [ApiController::class, 'pannelBt']);

Route::get('/v1/bot',[ApiController::class, 'createLeadFromBot']);
