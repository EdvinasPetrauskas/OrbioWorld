<?php

namespace App\Repository\Guest;

use App\Models\Guest;
use App\Services\Guest\GuestData;

class GuestRepository
{
    /**
     * @param GuestData $guestData
     * @return Guest
     */
    public function create(GuestData $guestData): Guest
    {
        $guest = new Guest([
            'name' => $guestData->getName(),
            'surname' => $guestData->getSurname(),
            'email' => $guestData->getEmail()
        ]);

        $guest->save();

        return $guest;
    }
}
