<?php

namespace Tests\Feature;

use App\Models\CargoType;
use App\Models\City;
use App\Models\Client;
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

        $this->post('/api/orders', $data)->assertStatus(201);
        $this->assertDatabaseHas('orders', $data);
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
