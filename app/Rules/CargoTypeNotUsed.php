<?php

namespace App\Rules;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class CargoTypeNotUsed implements Rule
{
    public function passes($attribute, $value)
    {
        return Order::query()
            ->whereNotIn('status', [OrderStatus::Done, OrderStatus::Declined])
            ->where('cargo_type_id', $value)
            ->doesntExist();
    }

    public function message()
    {
        return 'Удаление невозможно, этот тип груза используется в активном заказе.';
    }
}
