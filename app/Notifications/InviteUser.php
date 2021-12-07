<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteUser extends Notification implements ShouldQueue
{
    use Queueable;


    public function __construct()
    {
        //
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
            ->line('Вы были приглашены зарегемстрироваться на сайте по оказанию логистических услуг.')
            ->action('Зарегестрироваться можно по этой ссылке', url('/'))
            ->line('Спасибо за использование платформы');
    }
}
