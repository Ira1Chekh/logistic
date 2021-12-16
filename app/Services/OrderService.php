<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\City;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Stripe\SetupIntent;

class OrderService
{
    const EARTH_RADIUS_IN_KM = 6371;

    public function index(User $user): AnonymousResourceCollection
    {
        return OrderResource::collection(
            Order::query()
                ->filteredList($user)
                ->with('cargoType', 'vehicleType', 'client', 'driver')
                ->paginate(Order::PAGINATION)
        );
    }

    public function show(Order $order, User $user): array
    {
        return [
            'order' => OrderResource::make($order),
            'intent' => $user->isClient() && $order->isPending() ? $this->makeIntentToPurchase($user) : null,
        ];
    }

    public function store(OrderRequest $request): OrderResource
    {
        $order = Order::make($request->validated());
        $order->price = $this->calculatePrice(
            $request->input('city_from'),
            $request->input('city_to'),
            $request->input('cargo_weight')
        );
        $order->client()->associate($request->user())
            ->cargoType()->associate($request->input('cargo_type'))
            ->vehicleType()->associate($request->input('vehicle_type'))
            ->cityFrom()->associate($request->input('city_from'))
            ->cityTo()->associate($request->input('city_to'))
            ->save();

        return OrderResource::make($order);
    }

    public function update(OrderRequest $request, Order $order): OrderResource
    {
        $order->fill($request->validated())
            ->cargoType()->associate($request->input('cargo_type'))
            ->vehicleType()->associate($request->input('vehicle_type'))
            ->cityFrom()->associate($request->input('city_from'))
            ->cityTo()->associate($request->input('city_to'));
        $order->update(['price' => $this->calculatePrice(
            $request->input('city_from'),
            $request->input('city_to'),
            $request->input('cargo_weight')
        )]);

        return OrderResource::make($order);
    }

    public function makeIntentToPurchase(User $user): SetupIntent
    {
        return $user->createSetupIntent();
    }

    public function getCityById(int $cityId): City
    {
        return City::query()->find($cityId);
    }

    public function calculatePrice(int $cityFrom, int $cityTo, int $cargoWeight): float|int
    {
        $cityFrom = $this->getCityById($cityFrom);
        $cityTo = $this->getCityById($cityTo);

        return $this->calculateDistance($cityFrom, $cityTo) * $cargoWeight;
    }

    public function calculateDistance(City $cityFrom, City $cityTo): float|int
    {
        // convert degree to radians
        $long1 = deg2rad($cityFrom->longitude);
        $long2 = deg2rad($cityTo->longitude);
        $lat1 = deg2rad($cityFrom->latitude);
        $lat2 = deg2rad($cityTo->latitude);

        // Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati / 2),2)
            + cos($lat1) * cos($lat2)
            * pow(sin($dlong / 2),2);

        $res = 2 * asin(sqrt($val));

        return ($res * self::EARTH_RADIUS_IN_KM);
    }
}
