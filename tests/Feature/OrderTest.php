<?php

namespace Tests\Feature;

use App\Models\CargoType;
use App\Models\City;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;
use App\Models\VehicleType;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $seed = true;
    protected $seeder = DatabaseSeeder::class;

    public $client;
    public CargoType $cargoType;
    public VehicleType $vehicleType;
    public City $cityFrom;
    public City $cityTo;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->client = $this->signInAsClient();
        $this->cargoType = CargoType::first();
        $this->vehicleType = VehicleType::first();
        $this->cityFrom = City::first();
        $this->cityTo = City::find(2);
    }

    public function test_order_can_be_stored()
    {
        $data = $this->getOrderData();
        $this->post(route('orders.store'), $data)->assertStatus(201);
        $this->assertDatabaseHas('orders',
            $this->getDatabaseOrderData($data, ['cargo_type', 'vehicle_type', 'city_from', 'city_to'])
        );
    }

    public function test_order_can_be_updated()
    {
        $order = Order::factory()->create();
        $data = $this->getOrderData();
        $this->put(route('orders.update', [$order->id]), $data)->assertStatus(200);
        $this->assertDatabaseHas('orders',
            $this->getDatabaseOrderData($data, ['cargo_type', 'vehicle_type', 'city_from', 'city_to'])
        );
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

    protected function signInAsClient()
    {
        $client = User::factory()->client()->create();
        Sanctum::actingAs($client, ['*']);

        return $client;
    }
}
