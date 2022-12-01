<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ReservationDate implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $reservationDate = Carbon::parse($value)->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        return $reservationDate >= $currentDate ?? false;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Invalid date selection. Please select current or future date.';
    }
}
