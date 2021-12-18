<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    protected const VEHICLE_TYPES = [
        'трал',
        'фургон',
        'фура',
        'тент',
        'борт',
        'маніпулятор',
        'ізотерма',
        'газель',
        'рефрижератор',
        'автоцистерна',
    ];

    public function run()
    {
        foreach (self::VEHICLE_TYPES as $item) {
            VehicleType::query()->firstOrCreate([
                'name' => $item,
            ]);
        }
    }
}
