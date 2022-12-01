<?php

declare(strict_types=1);

namespace App\Services\Reservation;

use App\Exceptions\Reservation\ReservationInvalidDateException;
use App\Exceptions\Reservation\ReservationRestaurantNotAvailableException;
use App\Http\Requests\Reservation\ReservationStepOneRequestDTO;
use App\Http\Requests\Reservation\ReservationStepTwoRequestDTO;
use App\Repository\Booker\BookerRepository;
use App\Repository\BookerGuest\BookerGuestRepository;
use App\Repository\Guest\GuestRepository;
use App\Repository\Reservation\ReservationRepository;
use App\Services\ReservationEvent\ReservationEventService;
use App\Services\Table\TableIdsArrayFormatter;

class ReservationService
{
    /**
     * @param ReservationRepository $reservationRepository
     * @param BookerRepository $bookerRepository
     * @param GuestRepository $guestRepository
     * @param BookerGuestRepository $bookerGuestRepository
     * @param ReservationEventService $reservationEvent
     * @param TableIdsArrayFormatter $tableIdsArrayFormatter
     */
    public function __construct(
        private ReservationRepository   $reservationRepository,
        private BookerRepository        $bookerRepository,
        private GuestRepository         $guestRepository,
        private BookerGuestRepository   $bookerGuestRepository,
        private ReservationEventService $reservationEvent,
        private TableIdsArrayFormatter  $tableIdsArrayFormatter
    )
    {
    }

    /**
     * @param ReservationStepOneRequestDTO $stepOneRequestDTO
     * @param ReservationStepTwoRequestDTO $stepTwoRequestDTO
     * @return void
     * @throws ReservationInvalidDateException
     * @throws ReservationRestaurantNotAvailableException
     */
    public function reserve(
        ReservationStepOneRequestDTO $stepOneRequestDTO,
        ReservationStepTwoRequestDTO $stepTwoRequestDTO
    ): void
    {
        foreach ($stepTwoRequestDTO->getRestaurantTables() as $restaurantTable) {
            $this->reservationEvent->updatedExistingEvent(
                $stepOneRequestDTO->getRestaurantName(),
                $stepOneRequestDTO->getReservationDate(),
                $restaurantTable->getId()

            );
        }

        $booker = $this->bookerRepository->create($stepOneRequestDTO->getBooker());

        foreach ($stepTwoRequestDTO->getGuests() as $guest) {
            $guest = $this->guestRepository->create($guest);
            $this->bookerGuestRepository->create($booker->id, $guest->id);
        }

        $this->reservationRepository->create(
            $booker->id,
            $stepOneRequestDTO->getRestaurantName(),
            $this->tableIdsArrayFormatter->formatArray($stepTwoRequestDTO->getRestaurantTables()),
            $stepOneRequestDTO->getReservationDate()
        );
    }
}
