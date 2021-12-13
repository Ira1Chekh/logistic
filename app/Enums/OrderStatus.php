<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Request()
 * @method static static Pending()
 * @method static static Paid()
 * @method static static In_progress()
 * @method static static Done()
 * @method static static Declined()
 */
final class OrderStatus extends Enum
{
    const Request = 'request';
    const Pending = 'pending';
    const Paid = 'paid';
    const In_progress = 'in_progress';
    const Done = 'done';
    const Declined = 'declined';
}
