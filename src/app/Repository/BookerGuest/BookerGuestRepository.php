<?php

namespace App\Repository\BookerGuest;

use App\Models\BookerGuest;

class BookerGuestRepository
{
    /**
     * @param int $bookerId
     * @param int $guestId
     * @return BookerGuest
     */
    public function create(int $bookerId, int $guestId): BookerGuest
    {
        $bookerGuest = new BookerGuest([
            'booker_id' => $bookerId,
            'guest_id' => $guestId
        ]);

        $bookerGuest->save();

        return $bookerGuest;
    }
}
