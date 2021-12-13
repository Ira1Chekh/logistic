<?php

namespace App\Notifications;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class OrderStatusWasChanged extends Notification implements ShouldQueue
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
            ->subject('Заказ проверен')
            ->greeting('Здравствуйте '.$notifiable->full_name.'!')
            ->line($this->generateMessage())
            ->action('Посмотреть свои заказы можно по этой ссылке',
                URL::signedRoute(route('orders'))
            )
            ->action('Также вы можете связаться с оператором с помощью контактов на главной странице',
                URL::signedRoute(route('home'))
            )
            ->line('Спасибо за использование платформы.')
            ->salutation('С уважением, команда Logistics.');
    }

    private function generateMessage()
    {
        return match($this->order->status) {
            OrderStatus::Pending() => '',
            OrderStatus::In_progress() => '',
            OrderStatus::Paid() => '',
            OrderStatus::Declined() => '',
            OrderStatus::Done() => ''
        };
    }
}
