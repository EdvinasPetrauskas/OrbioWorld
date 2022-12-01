<?php

namespace App\Repository\RestaurantTable;

use App\Models\RestaurantTable;

class RestaurantTableRepository
{
    /**
     * @param int $id
     * @return RestaurantTable
     */
    public function get(int $id): RestaurantTable
    {
        return RestaurantTable::find($id);
    }
}
