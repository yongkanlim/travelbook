<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationApiController;
use App\Http\Controllers\Api\RecommendAttractionController;

// Route::get('/destinations', [DestinationApiController::class, 'index']);

Route::apiResource('recommend-attractions', RecommendAttractionController::class);