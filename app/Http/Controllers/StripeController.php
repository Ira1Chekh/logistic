<?php

namespace App\Http\Controllers;

use App\Models\Order;

class StripeController extends Controller
{
    public function show(Order $order)
    {
        return view('stripe', ['order' => $order]);
    }
}
