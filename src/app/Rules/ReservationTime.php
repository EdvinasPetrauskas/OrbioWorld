<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ReservationTime implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $currentDateTime = Carbon::now()->setTimezone('GMT+2');
        $currentTime = Carbon::createFromTime(
            $currentDateTime->hour,
            $currentDateTime->minute,
            $currentDateTime->second,
        );

        $reservationDateTime = Carbon::parse($value);
        $reservationTime = Carbon::createFromTime(
            $reservationDateTime->hour,
            $reservationDateTime->minute,
            $reservationDateTime->second,
        );


        if ($currentDateTime->format('Y-m-d') === $reservationDateTime->format('Y-m-d')) {
            return $reservationTime >= $currentTime ?? false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Invalid time selected. Passed hour selected.';
    }
}
