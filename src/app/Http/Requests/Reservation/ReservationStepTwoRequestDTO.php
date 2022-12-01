<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

class ReservationStepTwoRequestDTO
{
    /**
     * @param array $restaurantTables
     * @param array $guests
     */
    public function __construct(
        private array $restaurantTables,
        private array $guests = []
    ) {
    }

    /**
     * @return array
     */
    public function getRestaurantTables(): array
    {
        return $this->restaurantTables;
    }

    /**
     * @return array
     */
    public function getGuests(): array
    {
        return $this->guests;
    }
}
