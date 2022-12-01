<?php

namespace App\Exceptions\Reservation;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class ReservationRestaurantNotAvailableException extends Exception
{
    /**
     * @var string
     */
    private string $restaurantName;

    /**
     * @var string
     */
    private string $reservationHour;

    /**
     * @param string $restaurantName
     * @param string $reservationHour
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $restaurantName, string $reservationHour, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->restaurantName = $restaurantName;
        $this->reservationHour = $reservationHour;
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Restaurant ' . $this->restaurantName .' is fully booked for ' . $this->reservationHour . '. Try different hour.'
            ]
        ], 422);
    }
}
