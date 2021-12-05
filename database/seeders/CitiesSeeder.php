<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    public function run()
    {
        $this->seedFromJson(
            file_get_contents(base_path('database/seeders/cities/ukraine.json')),
            Country::where('name', 'Ukraine')->firstOrFail(),
        );
    }

    private function seedFromJson(string $json, Country $country): void
    {
        $cities = collect(json_decode($json, true))->map(function ($city) {
            return City::make($city);
        });

        $country->cities()->saveMany($cities);
    }
}
