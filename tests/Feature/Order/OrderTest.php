<?php

namespace Tests\Feature\Order;

use App\Models\CargoType;
use App\Models\City;
use App\Models\Order;
use App\Models\VehicleType;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $seed = true;
    protected $seeder = DatabaseSeeder::class;

    public CargoType $cargoType;
    public VehicleType $vehicleType;
    public City $cityFrom;
    public City $cityTo;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->cargoType = CargoType::first();
        $this->vehicleType = VehicleType::first();
        $this->cityFrom = City::first();
        $this->cityTo = City::find(2);
    }

    protected function checkStatusUpdate(string $status)
    {
        $order = Order::factory()->create();
        $this->put(route('orders.status.update', [$order->id]), ['status' => $status])->assertStatus(200);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => $status]);
    }

    protected function checkUpdate()
    {
        $order = Order::factory()->create();
        $data = $this->getOrderData();
        $this->put(route('orders.update', [$order->id]), $data)->assertStatus(200);
        $this->assertDatabaseHas('orders',
            $this->getDatabaseOrderData($data, ['cargo_type', 'vehicle_type', 'city_from', 'city_to'])
        );
    }

    public function checkShow()
    {
        $order = Order::factory()->create();
        $this->get(route('orders.show', [$order->id]))->assertStatus(200);
    }

    public function checkIndex()
    {
        Order::factory()->count(3)->create();
        $this->get(route('orders.index'))->assertStatus(200);
    }

    protected function getDatabaseOrderData(array $data, array $keys): array
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $keys)) {
                $data[$key.'_id'] = $value;
                unset($data[$key]);
            }
        }

        return $data;
    }

    protected function getOrderData(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'cargo_weight' => $this->faker->numberBetween(1, 999),
            'cargo_type' => $this->cargoType->id,
            'vehicle_type' => $this->vehicleType->id,
            'start_date' => $this->faker->dateTimeBetween('+2 days', '+4 days')->format('Y-m-d'),
            'due_date' => $this->faker->dateTimeBetween('+6 days', '+8 days')->format('Y-m-d'),
            'city_from' => $this->cityFrom->id,
            'city_to' => $this->cityTo->id,
        ];
    }
}
