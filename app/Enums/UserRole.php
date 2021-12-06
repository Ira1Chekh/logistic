<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Manager()
 * @method static static Client()
 * @method static static Driver()
 */
final class UserRole extends Enum
{
    const Manager = 'manager';
    const Client = 'client';
    const Driver = 'driver';
}
