<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LibraryController;

Route::get('/books', [LibraryController::class, 'books']);
Route::get('/loans', [LibraryController::class, 'loans']);
Route::post('/borrow', [LibraryController::class, 'borrow']);
Route::post('/return', [LibraryController::class, 'returnBook']);
