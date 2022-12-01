<?php

declare(strict_types=1);

namespace App\Services\Table;

use App\Repository\ReservationEvent\ReservationEventRepository;


class TableDataMerger
{
    /**
     * @param ReservationEventRepository $reservationEventRepository
     * @param TableSeats $tableSeats
     */
    public function __construct(
        private ReservationEventRepository $reservationEventRepository,
        private TableSeats                 $tableSeats
    ) {
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @return array
     */
    public function getAllRestaurantTableIdsAndSeatsArray(string $restaurantName, string $reservationDate): array
    {
        $tablesIds = $this->reservationEventRepository->getByRestaurantNameAndDate(
            $restaurantName,
            $reservationDate
        )->available_restaurant_tables_ids;

        $tables = [];

        foreach ($tablesIds as $tablesId) {
            $seats = $this->tableSeats->getByPivotRowId($tablesId);
            $tables[] = [
                'id' => $tablesId,
                'seats' => $seats
            ];
        }

        return $tables;
    }
}
