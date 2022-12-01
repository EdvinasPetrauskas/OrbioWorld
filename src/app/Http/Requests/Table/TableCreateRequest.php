<?php

declare(strict_types=1);

namespace App\Http\Requests\Table;

use Illuminate\Foundation\Http\FormRequest;

class TableCreateRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'seats' => ['integer', 'required']
        ];
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        $validatedData = $this->validated();

        return $validatedData['seats'];
    }
}
