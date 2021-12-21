<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Driver;
use App\Models\Order;
use App\Notifications\DriverWasAssignedToOrder;

class AssignDriverToOrder extends Controller
{
    public function __invoke(Order $order, Driver $driver): OrderResource
    {
        $order->driver()->associate($driver)->save();
        $driver->notify(new DriverWasAssignedToOrder($order));

        return OrderResource::make($order);
    }
}
