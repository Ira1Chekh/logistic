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
            ->subject('Приглашение на регистрацию')
            ->greeting('Здравствуйте!')
            ->line('Вы были приглашены зарегемстрироваться на сайте Logistics.')
            ->action('Зарегестрироваться можно по этой ссылке',
                URL::signedRoute(route($this->role.'.register'))
            )
            ->line('Спасибо за использование платформы.')
            ->salutation('С уважением, команда Logistics.');
    }
}
