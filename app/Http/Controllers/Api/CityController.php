<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DictionaryResource;
use App\Models\City;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CityController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return DictionaryResource::collection(City::all());
    }
}
