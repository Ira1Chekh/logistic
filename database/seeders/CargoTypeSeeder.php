<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Seeder;

class CargoTypeSeeder extends Seeder
{
    protected const CARGO_TYPES = [
        'комерційний вантаж',
        'сипучий вантаж',
        'небезпечні/ вибухонебезпечні вантажі',
        'будівельні матеріали',
        'швидкопсовані вантажі',
        'медикаменти'
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
