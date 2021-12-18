<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    protected const COUNTRIES = [
        'Україна',
    ];

    public function run()
    {
        foreach (self::COUNTRIES as $country) {
            Country::firstOrCreate([
                'name' => $country,
            ]);
        }
    }
}
