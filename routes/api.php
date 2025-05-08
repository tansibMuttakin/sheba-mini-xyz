<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminBookingController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public APIs
Route::get('/services', [ServiceController::class, 'index']);

// protected APIs
Route::middleware(['auth:sanctum'])->group(function () {
    //service apis
    route::group(['prefix' => 'services'], function () {
        Route::post('/', [ServiceController::class, 'store']);
    });

    //booking apis
    Route::prefix('bookings')->group(function () {
        Route::post('/', [BookingController::class, 'store']);
        Route::get('/{booking}', [BookingController::class, 'show']);
    });
});


// Admin APIs
Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::apiResource('services', ServiceController::class);

    Route::get('bookings', [AdminBookingController::class, 'index']);
});