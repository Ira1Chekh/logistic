<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Notifications\OrderStatusWasChanged;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function __invoke(Request $request, Order $order)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($order->price * 100, $paymentMethod);
            $order->update(['status' => OrderStatus::Paid]);
        } catch (\Exception $exception) {
            return back()->with('error', 'Произошла ошибка, свяжитесь с менеджером');
        }

        $user->notify(new OrderStatusWasChanged($order));

        return OrderResource::make($order);
    }
}
