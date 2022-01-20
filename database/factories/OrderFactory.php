<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\CargoType;
use App\Models\City;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'status' => OrderStatus::Request,
            'cargo_type_id' => CargoType::query()->inRandomOrder()->first(),
            'cargo_weight' => $this->faker->numberBetween(30, 999),
            'city_from_id' => City::query()->inRandomOrder()->first(),
            'city_to_id' => City::query()->inRandomOrder()->first(),
            'vehicle_type_id' => VehicleType::query()->inRandomOrder()->first(),
            'client_id' => Client::query()->inRandomOrder()->first() ?? User::factory()->client()->create(),
            'price' => $this->faker->numberBetween(1000, 99999),
            'start_date' => $this->faker->dateTimeBetween('+2 days', '+4 days')->format('Y-m-d'),
            'due_date' => $this->faker->dateTimeBetween('+6 days', '+8 days')->format('Y-m-d'),
        ];
    }

}
