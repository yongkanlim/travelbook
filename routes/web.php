<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\AttractionBookingController;

Route::get('/', [DestinationController::class, 'index']) ->name('destination');

Route::middleware('auth')->group(function () {
Route::resource('destinations', DestinationController::class);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
Route::get('/attractions', [AttractionController::class, 'index'])->name('attractions.index');
Route::get('/attractions/{attraction}', [AttractionController::class, 'show'])->name('attractions.show');
Route::post('/attractions/book', [AttractionBookingController::class, 'store'])
    ->name('attraction.book');
});

require __DIR__.'/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

// require __DIR__.'/auth.php';
