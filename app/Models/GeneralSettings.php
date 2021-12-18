<?php

namespace App\Models;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public float $fuel_price;

    public float $tax_percent;

    public float $enterprise_percent;

    public static function group(): string
    {
        return 'general';
    }
}
