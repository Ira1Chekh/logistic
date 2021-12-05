<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    protected const COUNTRIES = [
        'Ukraine',
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
