<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'fuel_price' => $this->fuel_price,
            'tax_percent' => $this->tax_percent,
            'enterprise_percent' => $this->enterprise_percent,
        ];
    }
}
