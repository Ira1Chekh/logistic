<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->authorizeResource(Order::class, 'order');
        $this->orderService = $orderService;
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return $this->orderService->index($request->user());
    }

    public function store(OrderRequest $request): OrderResource
    {
        return $this->orderService->store($request);
    }

    public function show(Order $order): OrderResource
    {
        return $this->orderService->show($order, auth()->user());
    }

    public function update(OrderRequest $request, Order $order): OrderResource
    {
        return $this->orderService->update($request, $order);
    }
}
