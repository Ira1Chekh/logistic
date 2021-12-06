<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    protected const CARGO_TYPES = [
        'коммерческий груз',
        'сыпучий груз',
        'опасные/ взрывоопасные грузы',
        'строительные материалы',
        'скоропортящиеся грузы',
        'медикаменты'
    ];

    public function run()
    {
        foreach (self::CARGO_TYPES as $item) {
            CargoType::query()->firstOrCreate([
                'name' => $item,
            ]);
        }
    }
}
