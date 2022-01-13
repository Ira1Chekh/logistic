<?php

namespace App\Http\Controllers;

use App\Models\CargoType;
use App\Models\VehicleType;

class HomeController extends Controller
{
    public function __invoke()
    {
        $cargoTypes = CargoType::query()->pluck('name', 'id');
        $vehicleTypes = VehicleType::query()->pluck('name', 'id');

        return view('home', compact('cargoTypes', 'vehicleTypes'));
    }
}
