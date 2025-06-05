<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;


Route::post("/v1/webhook", [ApiController::class, 'webhook']);
