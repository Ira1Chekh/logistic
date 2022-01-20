<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Tests\SignInAsDriver;

class OrderDriverTest extends OrderTest
{
    use SignInAsDriver;

    public $driver;

    public function setUp(): void
    {
        parent::setUp();
        $this->driver = $this->signInAsDriver();
    }

    public function test_order_can_not_be_stored()
    {
        $data = $this->getOrderData();
        $this->post(route('orders.store'), $data)->assertStatus(403);
    }

    public function test_order_can_not_be_updated()
    {
        $order = Order::factory()->create();
        $data = $this->getOrderData();
        $this->put(route('orders.update', [$order->id]), $data)->assertStatus(403);
    }

    public function test_order_status_can_be_updated()
    {
        $this->checkStatusUpdate('in_progress');
    }

    public function test_order_can_be_viewed()
    {
        $order = Order::factory()->create(['driver_id' => $this->driver->id]);
        $this->get(route('orders.show', [$order->id]))->assertStatus(200);
    }

    public function test_orders_can_be_viewed()
    {
        $this->checkIndex();
    }
}
