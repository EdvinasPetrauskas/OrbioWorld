<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Reservation\ReservationRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @param ReservationRepository $reservationRepository
     */
    public function __construct(
        private ReservationRepository $reservationRepository
    ) {
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $reservations = $this->reservationRepository->getAll();

        return view('admin.index', compact('reservations'));
    }
}
