<?php

namespace Tests\Feature\Order;

use Tests\SignInAsManager;

class OrderManagerTest extends OrderTest
{
    use SignInAsManager;

    public $manager;

    public function setUp(): void
    {
        parent::setUp();
        $this->manager = $this->signInAsManager();
    }

    public function test_order_can_not_be_stored()
    {
        $data = $this->getOrderData();
        $this->post(route('orders.store'), $data)->assertStatus(403);
    }

    public function test_order_can_be_updated()
    {
        $this->checkUpdate();
    }

    public function test_order_status_can_be_updated()
    {
        $this->checkStatusUpdate('pending');
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
