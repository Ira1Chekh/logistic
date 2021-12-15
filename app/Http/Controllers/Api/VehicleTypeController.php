<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\DictionaryResource;
use App\Models\VehicleType;

class VehicleTypeController
{
    public function index()
    {
        return DictionaryResource::collection(VehicleType::all());
    }

    public function store(TypeRequest $request)
    {
        $vehicleType = VehicleType::create($request->validated());

        return DictionaryResource::make($vehicleType);
    }

    public function show(VehicleType $vehicleType)
    {
        return DictionaryResource::make($vehicleType);
    }

    public function update(TypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->validated());

        return DictionaryResource::make($vehicleType);
    }

    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        return response()->noContent();
    }
}
