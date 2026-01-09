<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatalogController;

Route::get('/books', [CatalogController::class, 'books']);
