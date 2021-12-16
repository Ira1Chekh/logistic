<?php

namespace App\Rules;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class VehicleTypeNotUsed implements Rule
{
    public function passes($attribute, $value)
    {
        return Order::query()
            ->whereNotIn('status', [OrderStatus::Done, OrderStatus::Declined])
            ->where('vehicle_type_id', $value)
            ->doesntExist();
    }

    public function message()
    {
        return 'Удаление невозможно, этот тип кузова используется в активном заказе.';
    }
}
