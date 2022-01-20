<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Tests\SignInAsClient;

class OrderClientTest extends OrderTest
{
    use SignInAsClient;

    public $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = $this->signInAsClient();
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
        $this->checkUpdate();
    }

    public function test_order_status_can_be_updated()
    {
        $this->checkStatusUpdate('declined');
    }

    public function test_order_status_can_not_be_updated_to_paid()
    {
        $order = Order::factory()->create();
        $this->put(route('orders.status.update', [$order->id]), ['status' => 'paid'])->assertStatus(302);
    }

    public function test_order_can_be_viewed()
    {
        $this->checkShow();
    }

    public function test_orders_can_be_viewed()
    {
        $this->checkIndex();
    }
}
