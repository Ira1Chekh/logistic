<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\CargoType;

class CargoTypeController extends Controller
{
    public function index()
    {
        return TypeResource::collection(CargoType::all());
    }

    public function store(TypeRequest $request)
    {
        $cargoType = CargoType::create($request->validated());

        return TypeResource::make($cargoType);
    }

    public function show(CargoType $cargoType)
    {
        return TypeResource::make($cargoType);
    }

    public function update(TypeRequest $request, CargoType $cargoType)
    {
        $cargoType->update($request->validated());

        return TypeResource::make($cargoType);
    }

    public function destroy(CargoType $cargoType)
    {
        $cargoType->delete();

        return response()->noContent();
    }
}
