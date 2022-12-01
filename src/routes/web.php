<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'reservation'], function() {
        Route::get('/step-one', [ReservationController::class, 'reservationStepOneView'])
            ->name('reservation-step-one');
        Route::get('/step-two', [ReservationController::class, 'reservationStepTwoView'])
            ->name('reservation-step-two');

        Route::post('/step-one', [ReservationController::class, 'reservationStepOneStore'])
            ->name('reservation-step-one-store');
        Route::post('/step-two', [ReservationController::class, 'reservationStepTwoStore'])
            ->name('reservation-step-two-store');
    });
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

require __DIR__.'/auth.php';
