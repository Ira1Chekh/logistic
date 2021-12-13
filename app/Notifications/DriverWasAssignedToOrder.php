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
            ->subject('Заказ назначен')
            ->greeting('Здравствуйте '.$notifiable->full_name.'!')
            ->line('Вам назначили заказ '.$this->order->name.'.')
            ->action('Посмотреть подробности заказа можно по этой ссылке',
                URL::signedRoute(route('orders.show', [$this->order]))
            )
            ->line('Спасибо за использование платформы.')
            ->salutation('С уважением, команда Logistics.');
    }
}
