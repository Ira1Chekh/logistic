<?php

namespace App\Http\Requests;

use App\Rules\CargoTypeNotUsed;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCargoTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cargo_type' => [new CargoTypeNotUsed()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'cargo_type' => $this->route('cargo_type'),
        ]);
    }
}
