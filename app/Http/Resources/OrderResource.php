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
            'start_date' => $this->start_date->format('d.m.Y H:i'),
            'due_date'  => $this->due_date->format('d.m.Y H:i'),
            'client' => UserResource::make($this->whenLoaded('client')),
            'driver' => UserResource::make($this->whenLoaded('driver')),
            'cargo_type' => $this->whenLoaded('cargoType', function () {
                return $this->cargoType->name;
            }),
            'vehicle_type' => $this->whenLoaded('vehicleType', function () {
                return $this->vehicleType->name;
            }),
            'city_from' => $this->whenLoaded('cityFrom', function () {
                return $this->cityFrom->name;
            }),
            'city_to' => $this->whenLoaded('cityTo', function () {
                return $this->cityTo->name;
            }),
            'documents' => DocumentResource::collection($this->whenLoaded('media')),
        ];
    }

}
