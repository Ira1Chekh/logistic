<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteCargoTypeRequest;
use App\Http\Requests\TypeRequest;
use App\Http\Resources\DictionaryResource;
use App\Models\CargoType;

class CargoTypeController extends Controller
{
    public function index()
    {
        return DictionaryResource::collection(CargoType::all());
    }

    public function store(TypeRequest $request)
    {
        $cargoType = CargoType::create($request->validated());

        return DictionaryResource::make($cargoType);
    }

    public function show(CargoType $cargoType)
    {
        return DictionaryResource::make($cargoType);
    }

    public function update(TypeRequest $request, CargoType $cargoType)
    {
        $cargoType->update($request->validated());

        return DictionaryResource::make($cargoType);
    }

    public function destroy(DeleteCargoTypeRequest $request, CargoType $cargoType)
    {
        $cargoType->delete();

        return response()->noContent();
    }
}
