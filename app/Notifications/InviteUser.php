<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class InviteUser extends Notification implements ShouldQueue
{
    use Queueable;

    public string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Запрошення на реєстрацію')
            ->greeting('Вітаю!')
            ->line('Ви були запрошені зареєструватися на сайті з надання логістичних послуг.')
            ->action('Зареєструватися можна за цим посиланням: ',
                URL::signedRoute($this->role.'.register')
            )
            ->line('Дякуємо за використання платформи.')
            ->salutation('З повагою, команда Logistics.');
    }
}
