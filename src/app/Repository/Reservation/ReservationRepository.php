<?php

namespace App\Repository\Reservation;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Reservation::all();
    }

    /**
     * @param int $bookerId
     * @param string $restaurantName
     * @param string $reservationDate
     * @param array $reservedRestaurantTablesIds
     * @return Reservation
     */
    public function create(
        int $bookerId,
        string $restaurantName,
        array $reservedRestaurantTablesIds,
        string $reservationDate
    ): Reservation {
        $reservation = new Reservation([
            'booker_id' => $bookerId,
            'restaurant_name' => $restaurantName,
            'reserved_restaurant_tables_ids' => $reservedRestaurantTablesIds,
            'reservation_date' => $reservationDate
        ]);

        $reservation->save();

        return $reservation;
    }
}
