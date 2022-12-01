<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

use App\Services\Booker\BookerData;

class ReservationStepOneRequestDTO
{
    /**
     * @param BookerData $booker
     * @param string $reservationDate
     * @param string $restaurantName
     * @param int $guestsAmount
     */
    public function __construct(
        private BookerData $booker,
        private string     $reservationDate,
        private string     $restaurantName,
        private int        $guestsAmount,
    ) {
    }

    /**
     * @return BookerData
     */
    public function getBooker(): BookerData
    {
        return $this->booker;
    }

    /**
     * @return string
     */
    public function getReservationDate(): string
    {
        return $this->reservationDate;
    }

    /**
     * @return string
     */
    public function getRestaurantName(): string
    {
        return $this->restaurantName;
    }

    /**
     * @return int
     */
    public function getGuestsAmount(): int
    {
        return $this->guestsAmount;
    }
}
