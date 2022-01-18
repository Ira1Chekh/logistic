<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController
{
    public function show(Order $order)
    {
        return view('order', ['order' => $order]);
    }
}
