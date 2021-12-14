<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        return OrderResource::collection(
            Order::query()
                ->filteredList($request->user())
                ->paginate(Order::PAGINATION)
        );
    }

    public function store(OrderRequest $request): OrderResource
    {
        $order = Order::make($request->validated())
            ->client()->associate($request->user())
            ->cargoType()->associate($request->input('cargo_type'))
            ->vehicleType()->associate($request->input('vehicle_type'))
            ->cityFrom()->associate($request->input('city_from'))
            ->cityTo()->associate($request->input('city_to'));

        return OrderResource::make($order);
    }

    public function show(Order $order): array
    {
        $user = auth()->user();

        if ($user->isClient() && $order->isPending()) {
            $intent = $user->createSetupIntent();
        }

        return [
            'order' => OrderResource::make($order),
            'intent' => $intent ?? null,
        ];
    }

    public function update(OrderRequest $request, Order $order): OrderResource
    {
        $order->fill($request->validated())
            ->cargoType()->associate($request->input('cargo_type'))
            ->vehicleType()->associate($request->input('vehicle_type'))
            ->cityFrom()->associate($request->input('city_from'))
            ->cityTo()->associate($request->input('city_to'));

        return OrderResource::make($order);
    }
}
