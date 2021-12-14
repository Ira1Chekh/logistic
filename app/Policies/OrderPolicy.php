<?php

namespace App\Policies;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, Order $order): bool
    {
        return $user->isManager() || $order->isOwned($user) || $order->isExecuted($user);
    }

    public function create(User $user): bool
    {
        return $user->isClient();
    }

    public function update(User $user, Order $order): bool
    {
        return ($user->isManager() && in_array($order->status, [OrderStatus::Request, OrderStatus::Pending]))
            || ($user->isClient() && $order->status == OrderStatus::Request);
    }
}
