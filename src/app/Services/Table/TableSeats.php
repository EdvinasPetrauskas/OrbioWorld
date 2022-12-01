<?php

declare(strict_types=1);

namespace App\Services\Table;

use App\Repository\RestaurantTable\RestaurantTableRepository;
use App\Repository\Table\TableRepository;

class TableSeats
{
    /**
     * @param RestaurantTableRepository $restaurantTableRepository
     * @param TableRepository $tableRepository
     */
    public function __construct(
        private RestaurantTableRepository $restaurantTableRepository,
        private TableRepository           $tableRepository
    )
    {
    }

    /**
     * @param int $restaurantTableId
     * @return int
     */
    public function getByPivotRowId(int $restaurantTableId): int
    {
        $restaurantTable = $this->restaurantTableRepository->get($restaurantTableId);

        return $this->tableRepository->get($restaurantTable->table_id)->seats;
    }
}
