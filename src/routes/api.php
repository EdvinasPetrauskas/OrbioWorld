<?php

use App\Http\Controllers\api\Reservation\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/reserve', [ReservationController::class, 'reserve'])
    ->name('reserve');
