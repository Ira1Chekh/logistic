<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use App\Http\Resources\SettingsResource;
use App\Models\GeneralSettings;

class SettingsController extends Controller
{
    public function index()
    {
        return SettingsResource::make(app(GeneralSettings::class));
    }

    public function store(SettingsRequest $request)
    {
        $settings = app(GeneralSettings::class);

        $settings->fuel_price = $request->input('fuel_price');
        $settings->tax_percent = $request->input('tax_percent');
        $settings->enterprise_percent = $request->input('enterprise_percent');
        $settings->save();

        return SettingsResource::make($settings);
    }
}
