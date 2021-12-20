<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'status_name' => OrderStatus::getDescription($this->status),
            'description' => $this->description,
            'cargo_weight' => $this->cargo_weight,
            'price' => $this->price,
            'start_date' => $this->start_date->format('Y-m-d'),
            'due_date'  => $this->due_date->format('Y-m-d'),
            'client' => UserResource::make($this->whenLoaded('client')),
            'driver' => UserResource::make($this->whenLoaded('driver')),
            'cargo_type' => CargoTypeResource::make($this->whenLoaded('cargoType')),
            'vehicle_type' => VehicleTypeResource::make($this->whenLoaded('vehicleType')),
            'city_from' => CityResource::make($this->whenLoaded('cityFrom')),
            'city_to' => CityResource::make($this->whenLoaded('cityTo')),
            'documents' => DocumentResource::collection($this->whenLoaded('media')),
        ];
    }
}
