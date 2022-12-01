<?php

namespace App\Exceptions\Reservation;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class ReservationInvalidDateException extends Exception
{
    /**
     * @var string
     */
    private string $restaurantName;

    /**
     * @var string
     */
    private string $reservationDate;

    /**
     * @param string $restaurantName
     * @param string $reservationDate
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $restaurantName, string $reservationDate, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->restaurantName = $restaurantName;
        $this->reservationDate = $reservationDate;
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => 'Selected table at ' . $this->restaurantName .' is already booked for ' . $this->reservationDate
            ]
        ], 422);
    }
}
