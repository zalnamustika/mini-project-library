<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecommendationController;

Route::get('/recommendations', [RecommendationController::class, 'recommendations']);
