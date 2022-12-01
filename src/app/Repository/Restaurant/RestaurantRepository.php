<?php

namespace App\Repository\Restaurant;

use App\Exceptions\Restaurant\RestaurantDuplicateModelException;
use App\Http\Requests\Restaurant\RestaurantCreateRequestDTO;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

class RestaurantRepository
{
    /**
     * @param string $restaurantName
     * @return Restaurant
     */
    public function getByName(string $restaurantName): Restaurant
    {
        /** @var Restaurant $restaurant */
        $restaurant = Restaurant::where('name', $restaurantName)->first();

        return $restaurant;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Restaurant::all();
    }

    /**
     * @param RestaurantCreateRequestDTO $requestDTO
     * @return void
     * @throws RestaurantDuplicateModelException
     */
    public function createWithTables(RestaurantCreateRequestDTO $requestDTO): void
    {
        if (Restaurant::where('name', $requestDTO->getName())->exists()) {
            throw new RestaurantDuplicateModelException();
        }

        $restaurant = new Restaurant([
            'name' => $requestDTO->getName()
        ]);

        $restaurant->save();

        foreach ($requestDTO->getTables() as $tableId) {
            $restaurant->tables()->attach($tableId);
        }
    }
}
