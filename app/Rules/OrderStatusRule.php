<?php

namespace App\Rules;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class OrderStatusRule implements Rule
{
    public Order $order;
    public User $user;

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    public function passes($attribute, $value)
    {
        return ($this->user->isManager() && in_array($value, [OrderStatus::Pending, OrderStatus::Declined]))
            || ($this->user->isClient() && $value === OrderStatus::Declined && $this->order->isRequest())
            || ($this->user->isDriver() && in_array($value, [OrderStatus::In_progress, OrderStatus::Done]));
    }

    public function message()
    {
        return 'Немає доступу до зміни статусу замовлення.';
    }
}
