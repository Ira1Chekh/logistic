<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderStatusWasChanged;

class OrderStatusController extends Controller
{
    public function __invoke(Order $order, OrderStatusRequest $request): OrderResource
    {
        $order->update($request->validated());

        if ($request->user()->isManager() || $request->user()->isDriver()) {
           $order->client->notify(new OrderStatusWasChanged($order));
        }

        return OrderResource::make($order);
    }
}
