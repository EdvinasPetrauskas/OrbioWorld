<?php

declare(strict_types=1);

namespace App\Http\Requests\Reservation;

use App\Models\RestaurantTable;
use App\Services\Guest\GuestData;
use App\Services\Table\TableData;
use Illuminate\Foundation\Http\FormRequest;

class ReservationStepTwoRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'restaurant_tables' => ['required', 'array'],
            'restaurant_tables.*' => [
                'required',
                'string',
                'bail',
                sprintf('exists:%s,id', RestaurantTable::class)
            ],
            'guests' => ['required', 'array'],
            'guests.*.name' => ['sometimes', 'required', 'string', 'max:255'],
            'guests.*.surname' => ['sometimes', 'required', 'string', 'max:255'],
            'guests.*.email' => ['sometimes', 'required', 'email', 'max:255']
        ];
    }

    /**
     * @return ReservationStepTwoRequestDTO
     */
    public function getRequestDTO(): ReservationStepTwoRequestDTO
    {
        $data = $this->validated();

        return new ReservationStepTwoRequestDTO(
            array_map(function (string $restaurantTable) {
                return new TableData(
                    (int) $restaurantTable
                );
            }, $data['restaurant_tables']),
            isset($data['guests']) ? array_map(function (array $guest) {
                return new GuestData(
                    $guest['name'],
                    $guest['surname'],
                    $guest['email']
                );
            }, $data['guests']) : null
        );
    }
}
