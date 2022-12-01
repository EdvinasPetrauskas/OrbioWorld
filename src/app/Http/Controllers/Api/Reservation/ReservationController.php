<?php

namespace App\Http\Controllers\Api\Reservation;

use App\Exceptions\Reservation\ReservationInvalidDateException;
use App\Exceptions\Reservation\ReservationRestaurantNotAvailableException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\ReservationStepOneRequest;
use App\Http\Requests\Reservation\ReservationStepTwoRequest;
use App\Repository\Restaurant\RestaurantRepository;
use App\Services\Reservation\ReservationService;
use App\Services\ReservationEvent\ReservationEventService;
use App\Services\Table\TableDataMerger;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @param RestaurantRepository $restaurantRepository
     * @param ReservationService $reservationService
     * @param ReservationEventService $reservationEventService
     * @param TableDataMerger $tableDataMerger
     */
    public function __construct(
        private RestaurantRepository       $restaurantRepository,
        private ReservationService         $reservationService,
        private ReservationEventService    $reservationEventService,
        private TableDataMerger            $tableDataMerger
    ) {
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function reservationStepOneView(Request $request): View|Factory|Application
    {
        $reservation = $request->session()->get('reservation');
        $restaurants = $this->restaurantRepository->getAll();

        return view('reservation-step-one', compact('reservation', 'restaurants'));
    }

    /**
     * @param ReservationStepOneRequest $request
     * @return RedirectResponse
     * @throws ReservationRestaurantNotAvailableException
     */
    public function reservationStepOneStore(ReservationStepOneRequest $request): RedirectResponse
    {
        $requestDTO = $request->getRequestDTO();

        $this->reservationEventService->createEvent(
            $requestDTO->getRestaurantName(),
            $requestDTO->getReservationDate()
        );

        $this->reservationEventService->checkAvailableSeats(
            $requestDTO->getRestaurantName(),
            $requestDTO->getReservationDate(),
            $requestDTO->getGuestsAmount(),
        );

        $reservation = $requestDTO;
        $request->session()->put('reservation', $reservation);

        return to_route('reservation-step-two');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function reservationStepTwoView(Request $request): Application|Factory|View
    {
        $reservation = $request->session()->get('reservation');

        $tables = $this->tableDataMerger->getAllRestaurantTableIdsAndSeatsArray(
            $reservation->getRestaurantName(),
            $reservation->getReservationDate()
        );

        $guestsAmount = $reservation->getGuestsAmount();

        return view('reservation-step-two', compact('tables', 'reservation', 'guestsAmount'));
    }

    /**
     * @param ReservationStepTwoRequest $request
     * @return RedirectResponse
     * @throws ReservationInvalidDateException
     * @throws ReservationRestaurantNotAvailableException
     */
    public function reservationStepTwoStore(ReservationStepTwoRequest $request): RedirectResponse
    {
        $stepOneRequestDTO = $request->session()->get('reservation');
        $stepTwoRequestDTO = $request->getRequestDTO();

        $this->reservationService->reserve($stepOneRequestDTO, $stepTwoRequestDTO);

        $request->session()->forget('reservation');

        return to_route('reservation-step-one')->with('success', 'Table has been reserved!');
    }
}
