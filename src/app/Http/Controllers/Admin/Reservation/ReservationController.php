<?php

namespace App\Http\Controllers\Admin\Reservation;

use App\Http\Controllers\Controller;
use App\Repository\Reservation\ReservationRepository;
use Illuminate\Http\JsonResponse;

class ReservationController extends Controller
{
    /**
     * @param ReservationRepository $reservationRepository
     */
    public function __construct(
        private ReservationRepository $reservationRepository
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function getReservations(): JsonResponse
    {
        $reservations = $this->reservationRepository->getAll();

        return $this->success($reservations->toArray());
    }
}
