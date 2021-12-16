<?php

namespace App\Http\Requests;

use App\Rules\VehicleTypeNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class DeleteVehicleTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'vehicle_type' => [new VehicleTypeNotUsed()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'vehicle_type' => $this->route('vehicle_type'),
        ]);
    }
}
