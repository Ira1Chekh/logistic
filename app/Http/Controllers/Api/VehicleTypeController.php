<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\VehicleType;

class VehicleTypeController
{
    public function index()
    {
        return TypeResource::collection(VehicleType::all());
    }

    public function store(TypeRequest $request)
    {
        $vehicleType = VehicleType::create($request->validated());

        return TypeResource::make($vehicleType);
    }

    public function show(VehicleType $vehicleType)
    {
        return TypeResource::make($vehicleType);
    }

    public function update(TypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->validated());

        return TypeResource::make($vehicleType);
    }

    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        return response()->noContent();
    }
}
