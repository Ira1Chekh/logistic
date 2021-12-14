<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusWasChanged;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function __invoke(Request $request, Order $order): RedirectResponse
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($order->price * 100, $paymentMethod);
        } catch (\Exception $exception) {
            return back()->with('error', 'Произошла ошибка, свяжитесь с менеджером');
        }

        $user->notify(new OrderStatusWasChanged($order));

        return back()->with('message', 'Заказ оплачен');
    }
}
