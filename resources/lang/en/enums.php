<?php

use App\Enums\OrderStatus;
use App\Enums\UserRole;

return [
    UserRole::class => [
        UserRole::Client => 'Client',
        UserRole::Driver => 'Driver',
        UserRole::Manager => 'Manager'
    ],
    OrderStatus::class => [
        OrderStatus::Request => 'Request',
        OrderStatus::Pending => 'Pending',
        OrderStatus::Paid => 'Paid',
        OrderStatus::In_progress => 'In Progress',
        OrderStatus::Done => 'Done',
        OrderStatus::Declined => 'Declined'
    ]
];
