<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationEmail
{
    public static function build(User $notifiable, string $url): MailMessage
    {
        return (new MailMessage())
            ->subject('Перевірте адресу електронної пошти')
            ->greeting('Вітаю, '.$notifiable->full_name.'!')
            ->line('Натисніть кнопку нижче, щоб підтвердити свою адресу електронної пошти.')
            ->action('Підтвердити адресу електронної пошти', $url)
            ->line('Якщо ви не створювали обліковий запис, не потрібно нічого робити.')
            ->line('Дякуємо за використання платформи.')
            ->salutation('З повагою, команда '.config('app.name').'.');
    }
}
