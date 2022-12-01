<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\RestaurantTable;
use App\Models\Table;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = [
            [
                'name' => 'Casa Della Pasta',
                'seats' => [2, 4, 8]
            ],
            [
                'name' => 'DIA',
                'seats' => [2, 2, 4]
            ],
            [
                'name' => 'Talutti',
                'seats' => [4, 4, 8]
            ]
        ];

        foreach ($restaurants as $restaurant) {
            /** @var Restaurant $restaurant */
            $restaurantModel = Restaurant::create([
                'name' => $restaurant['name']
            ]);


            foreach ($restaurant['seats'] as $seats) {
                /** @var Table $table */
                $table = Table::where('seats', $seats)->first();

                if (!$table) {
                    $table = Table::create([
                        'seats' => $seats
                    ]);
                }

                RestaurantTable::create([
                    'restaurant_id' => $restaurantModel->id,
                    'table_id' => $table->id,
                ]);
            }
        }
    }
}
