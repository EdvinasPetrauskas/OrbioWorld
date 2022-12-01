<?php

declare(strict_types=1);

namespace App\Services\ReservationEvent;

use App\Exceptions\Reservation\ReservationRestaurantNotAvailableException;
use App\Models\ReservationEvent;
use App\Repository\ReservationEvent\ReservationEventRepository;
use App\Repository\Restaurant\RestaurantRepository;
use App\Services\Restaurant\RestaurantMaxSeats;
use App\Services\Table\TableSeats;
use Carbon\Carbon;

class ReservationEventService
{
    /**
     * @param ReservationEventRepository $reservationEventRepository
     * @param RestaurantMaxSeats $restaurantMaxSeats
     * @param TableSeats $tableSeats
     * @param RestaurantRepository $restaurantRepository
     */
    public function __construct(
        private ReservationEventRepository $reservationEventRepository,
        private RestaurantMaxSeats         $restaurantMaxSeats,
        private TableSeats                 $tableSeats,
        private RestaurantRepository       $restaurantRepository
    )
    {
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @return void
     */
    public function createEvent(string $restaurantName, string $reservationDate): void
    {
        /** @var ReservationEvent|null $reservationEvent */
        $reservationEvent = $this->reservationEventRepository->getByRestaurantNameAndDate(
            $restaurantName,
            $reservationDate
        );

        if (is_null($reservationEvent)) {
            $this->reservationEventRepository->create(
                $restaurantName,
                $reservationDate,
                $this->getAvailableRestaurantTablesIdsArray($restaurantName),
                $this->restaurantMaxSeats->getAmount($restaurantName)
            );
        }
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @param int $restaurantTableId
     * @return void
     */
    public function updatedExistingEvent(string $restaurantName, string $reservationDate, int $restaurantTableId): void
    {
        /** @var ReservationEvent|null $reservationEvent */
        $reservationEvent = $this->reservationEventRepository->getByRestaurantNameAndDate(
            $restaurantName,
            $reservationDate
        );

        $availableRestaurantTablesIdsArray = $reservationEvent->available_restaurant_tables_ids;

        $this->reservationEventRepository->updateAvailableTablesAndSeats(
            $restaurantName,
            $reservationDate,
            array_values(array_diff($availableRestaurantTablesIdsArray, [$restaurantTableId])),
            $this->getAvailableSeats($restaurantTableId, $reservationEvent->available_seats)
        );
    }

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @param int $guestsAmount
     * @return bool
     * @throws ReservationRestaurantNotAvailableException
     */
    public function checkAvailableSeats(string $restaurantName, string $reservationDate, int $guestsAmount): bool
    {
        $reservationEvent = $this->reservationEventRepository->getByRestaurantNameAndDate(
            $restaurantName,
            $reservationDate
        );

        // + 1 including booker
        if ($guestsAmount + 1 <= $reservationEvent->available_seats) {
            return true;
        }

        $reservationHours = Carbon::parse($reservationDate)->format('H:i:s');

        throw new ReservationRestaurantNotAvailableException(
            $restaurantName,
            $reservationHours
        );
    }

    /**
     * @param string $restaurantName
     * @return array
     */
    private function getAvailableRestaurantTablesIdsArray(string $restaurantName): array
    {
        $tables = $this->restaurantRepository->getByName($restaurantName)->tables()->get();
        $availableTablesIds = [];

        foreach ($tables as $table) {
            $availableTablesIds[] = $table->pivot->id;
        }

        return $availableTablesIds;
    }

    /**
     * @param int $selectedTableId
     * @param int $currentTableSeats
     * @return int
     */
    private function getAvailableSeats(int $selectedTableId, int $currentTableSeats): int
    {
        $selectedTableSeats = $this->tableSeats->getByPivotRowId($selectedTableId);

        return $currentTableSeats - $selectedTableSeats;
    }
}
