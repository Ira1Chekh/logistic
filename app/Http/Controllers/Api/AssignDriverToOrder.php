<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use App\Notifications\DriverWasAssignedToOrder;

class AssignDriverToOrder extends Controller
{
    public function __invoke(Order $order, Driver $driver): \Illuminate\Http\RedirectResponse
    {
        $order->driver()->associate($driver);
        $driver->notify(new DriverWasAssignedToOrder($order));

        return back()->with('Водитель был назначен на заказ.');
    }
}
