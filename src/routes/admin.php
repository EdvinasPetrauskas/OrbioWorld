<?php

use App\Http\Controllers\Admin\Reservation\ReservationController;
use App\Http\Controllers\Admin\Restaurant\RestaurantController;
use App\Http\Controllers\Admin\Table\TableController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->group(function() {
    Route::post('/table', [TableController::class, 'createTable'])
        ->name('table-create');

    Route::post('/restaurant-with-tables', [RestaurantController::class, 'createRestaurantWithTables'])
        ->name('restaurant-create');

    Route::get('/reservations', [ReservationController::class, 'getReservations'])
        ->name('reservations-get');
});
