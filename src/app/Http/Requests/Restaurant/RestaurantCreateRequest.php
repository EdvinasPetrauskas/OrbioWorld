<?php

declare(strict_types=1);

namespace App\Http\Requests\Restaurant;

use App\Models\Table;
use Illuminate\Foundation\Http\FormRequest;

class RestaurantCreateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'tables' => ['array', 'required'],
            'tables.*' => [
                'required',
                'integer',
                'bail',
                sprintf('exists:%s,id', Table::class)
            ]
        ];
    }

    /**
     * @return RestaurantCreateRequestDTO
     */
    public function getRequestDTO(): RestaurantCreateRequestDTO
    {
        $validatedData = $this->validated();

        return new RestaurantCreateRequestDTO($validatedData['name'], $validatedData['tables']);
    }
}
