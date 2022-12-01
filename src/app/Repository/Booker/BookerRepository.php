<?php

namespace App\Repository\Booker;

use App\Models\Booker;
use App\Services\Booker\BookerData;

class BookerRepository
{
    /**
     * @param BookerData $bookerData
     * @return Booker
     */
    public function create(BookerData $bookerData): Booker
    {
        $booker = new Booker([
            'name' => $bookerData->getName(),
            'surname' => $bookerData->getSurname(),
            'email' => $bookerData->getEmail(),
            'phone' => $bookerData->getPhone()
        ]);

        $booker->save();

        return $booker;
    }
}
