<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class RestaurantOpeningClosingHours implements Rule
{
    private const OPEN_TIME = "12:00:00";
    private const CLOSE_TIME = "23:00:00";

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $reservationDateTime = Carbon::parse($value);
        $reservationTime = Carbon::createFromTime(
            $reservationDateTime->hour,
            $reservationDateTime->minute,
            $reservationDateTime->second,
        );

        $openTime = Carbon::createFromTimeString(self::OPEN_TIME);
        $closeTime = Carbon::createFromTimeString(self::CLOSE_TIME);

        return $reservationTime->between($openTime, $closeTime) ?? false;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Invalid time selected. Restaurant opens between ' . self::OPEN_TIME . ' - ' . self::CLOSE_TIME;
    }
}
