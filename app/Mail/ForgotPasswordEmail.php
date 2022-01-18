<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class ForgotPasswordEmail
{
    public static function build(User $notifiable, string $url): MailMessage
    {
        return (new MailMessage())
            ->subject('Повідомлення про скидання пароля')
            ->greeting('Вітаю, '.$notifiable->full_name.'!')
            ->line('Ви отримали цей електронний лист, оскільки ми отримали запит на скидання пароля для вашого облікового запису.')
            ->action('Скинути пароль', $url)
            ->line('Це посилання для скидання пароля закінчиться через 60 хвилин.')
            ->line('Якщо ви не запитували скидання пароля, не потрібно нічого робити.')
            ->line('Дякуємо за використання платформи.')
            ->salutation('З повагою, команда '.config('app.name').'.');
    }

}
