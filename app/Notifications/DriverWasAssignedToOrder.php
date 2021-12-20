<?php

namespace App\Notifications;

use App\Models\Driver;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class DriverWasAssignedToOrder extends Notification implements ShouldQueue
{
    use Queueable;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Заказ призначений')
            ->greeting('Вітаю, '.$notifiable->full_name.'!')
            ->line('Вам призначили на виконання заказ '.$this->order->name.'.')
            ->line('Переглянути деталі замовлення можна за посиланням:')
            ->action('Замовлення',
                URL::signedRoute(route('orders.show', [$this->order]))
            )
            ->line('Дякуємо за використання платформи.')
            ->salutation('З повагою, команда Logistics.');
    }
}
