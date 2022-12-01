<?php

namespace App\Repository\ReservationEvent;

use App\Models\ReservationEvent;

class ReservationEventRepository
{
    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @return ReservationEvent|null
     */
    public function getByRestaurantNameAndDate(string $restaurantName, string $reservationDate): ReservationEvent|null
    {
        /** @var ReservationEvent $reservationEvent */
        $reservationEvent = ReservationEvent::where('restaurant_name', $restaurantName)
            ->where('reservation_date', $reservationDate)->first();

        return $reservationEvent;
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @param array $availableRestaurantTablesIds
     * @param int $availableSeats
     * @return ReservationEvent
     */
    public function create(
        string $restaurantName,
        string $reservationDate,
        array  $availableRestaurantTablesIds,
        int    $availableSeats
    ): ReservationEvent
    {
        $reservationEvent = new ReservationEvent([
            'restaurant_name' => $restaurantName,
            'reservation_date' => $reservationDate,
            'available_restaurant_tables_ids' => $availableRestaurantTablesIds,
            'available_seats' => $availableSeats
        ]);

        $reservationEvent->save();

        return $reservationEvent;
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @param array $availableRestaurantTablesIds
     * @param int $availableSeats
     * @return ReservationEvent
     */
    public function updateAvailableTablesAndSeats(
        string $restaurantName,
        string $reservationDate,
        array  $availableRestaurantTablesIds,
        int    $availableSeats
    ): ReservationEvent
    {
        /** @var ReservationEvent $reservationEvent */
        $reservationEvent = ReservationEvent::where('restaurant_name', $restaurantName)
            ->where('reservation_date', $reservationDate)->first();

        $reservationEvent->available_restaurant_tables_ids = $availableRestaurantTablesIds;
        $reservationEvent->available_seats = $availableSeats;

        $reservationEvent->save();

        return $reservationEvent;
    }
}
