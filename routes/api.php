<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DestinationApiController;

Route::get('/destinations', [DestinationApiController::class, 'index']);