<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;


Route::post("/v1/webhook", [ApiController::class, 'webhook']);

Route::post('/v1/bot',[ApiController::class, 'botresponse']);
