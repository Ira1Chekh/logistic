<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Manager()
 * @method static static Client()
 * @method static static Driver()
 */
final class UserRole extends Enum implements LocalizedEnum
{
    const Manager = 'manager';
    const Client = 'client';
    const Driver = 'driver';
}
