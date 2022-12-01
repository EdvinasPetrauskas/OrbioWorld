<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

use App\Rules\ReservationDate;
use App\Rules\ReservationTime;
use App\Rules\RestaurantOpeningClosingHours;
use App\Services\Booker\BookerData;
use Illuminate\Foundation\Http\FormRequest;

class ReservationStepOneRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'booker' => ['required', 'array'],
            'booker.name' => ['required', 'string', 'max:255'],
            'booker.surname' => ['required', 'string', 'max:255'],
            'booker.email' => ['required', 'email', 'max:255'],
            'booker.phone' => ['required', 'numeric', 'digits:11'],
            'reservation_date' => [
                'required',
                new ReservationDate(),
                new ReservationTime(),
                new RestaurantOpeningClosingHours()
            ],
            'restaurant_name' => ['required', 'string'],
            'guests_amount' => ['sometimes', 'required', 'string']
        ];
    }

    /**
     * @return ReservationStepOneRequestDTO
     */
    public function getRequestDTO(): ReservationStepOneRequestDTO
    {
        $data = $this->validated();

        return new ReservationStepOneRequestDTO(
            new BookerData(
                $data['booker']['name'],
                $data['booker']['surname'],
                $data['booker']['email'],
                $data['booker']['phone']
            ),
            $data['reservation_date'],
            $data['restaurant_name'],
            (int)$data['guests_amount'] ?? 0
        );
    }
}
