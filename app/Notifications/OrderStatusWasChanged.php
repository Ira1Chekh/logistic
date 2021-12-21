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
            ->subject('Статус замовлення змінений')
            ->greeting('Вітаю, '.$notifiable->full_name.'!')
            ->line($this->generateMessage())
            ->line('Переглянути свої замовлення можна за посиланням:')
            ->action('Замовлення', route('orders.view', [$this->order->id]))
            ->line('Якщо у вас виникли питання, ви можете зв\'язатись з оператором чату на головній сторінці.')
            ->line('Дякуємо за використання платформи.')
            ->salutation('З повагою, команда Logistics.');
    }

    private function generateMessage()
    {
        return match($this->order->status->value) {
            OrderStatus::Pending => 'Ваш заказ був ухвалений менеджером. До слпати: '.$this->order->price,
            OrderStatus::Paid => 'Ваш заказ був успішно оплачений.',
            OrderStatus::In_progress => 'Ваш заказ прямує до місця призначення.',
            OrderStatus::Declined => 'Ваш заказ був відхилений менеджером.',
            OrderStatus::Done => 'Ваш заказ прибув на місце призначення.'
        };
    }
}
