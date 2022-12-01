<?php

declare(strict_types=1);

namespace App\Services\Restaurant;

use App\Repository\Restaurant\RestaurantRepository;

class RestaurantMaxSeats
{
    /**
     * @param RestaurantRepository $restaurantRepository
     */
    public function __construct(
        private RestaurantRepository $restaurantRepository
    ) {
    }

    /**
     * @param string $restaurantName
     * @return int
     */
    public function getAmount(string $restaurantName): int
    {
        $restaurantTables = $this->restaurantRepository->getByName($restaurantName)->tables()->get();

        $restaurantMaxSeatsAmount = 0;

        foreach ($restaurantTables as $table)
        {
            $restaurantMaxSeatsAmount += $table->seats;
        }

        return $restaurantMaxSeatsAmount;
    }
}
