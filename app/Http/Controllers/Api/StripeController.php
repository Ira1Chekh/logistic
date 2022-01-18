<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StripeRequest;
use App\Models\Order;
use App\Notifications\OrderStatusWasChanged;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Stripe;

class StripeController extends Controller
{
    public function store(StripeRequest $request, Order $order): RedirectResponse
    {
        try {
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            Stripe\Charge::create ([
                "amount" => $order->price * 100,
                "currency" => config('services.stripe.currency'),
                "source" => $request->input('stripeToken'),
                "description" => "Оплата замовлення ".$order->name." на сайті ".config('app.name')
            ]);
            $order->update(['status' => OrderStatus::Paid]);
        } catch (\Exception $exception) {
            Session::flash('error', 'Виникла помилка, перевірте введені дані й зв\'яжіться з менеджером.');
        }

        $order->client->notify(new OrderStatusWasChanged($order));

        Session::flash('success', 'Платіж успішно оброблено.');

        return redirect()->route('orders');
    }
}
