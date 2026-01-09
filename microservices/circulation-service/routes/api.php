<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CirculationController;

Route::get('/loans', [CirculationController::class, 'loans']);
Route::post('/borrow', [CirculationController::class, 'borrow']);
Route::post('/return', [CirculationController::class, 'returnBook']);
