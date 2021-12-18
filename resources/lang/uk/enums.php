<?php

use App\Enums\OrderStatus;
use App\Enums\UserRole;

return [
    UserRole::class => [
        UserRole::Client => 'Клієнт',
        UserRole::Driver => 'Водій',
        UserRole::Manager => 'Менеджер'
    ],
    OrderStatus::class => [
        OrderStatus::Request => 'Не розглянутий',
        OrderStatus::Pending => 'На розгляді',
        OrderStatus::Paid => 'Сплачений',
        OrderStatus::In_progress => 'В роботі',
        OrderStatus::Done => 'Зроблений',
        OrderStatus::Declined => 'Відхилений'
    ]
];
