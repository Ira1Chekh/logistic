<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'cargo_weight' => ['required', 'numeric', 'min:0', 'max:99999'],
            'cargo_type' => ['required', 'exists:cargo_types,id'],
            'vehicle_type' => ['required', 'exists:vehicle_types,id'],
            'start_date' => ['required', 'date', 'after:'.now()->toDateString()],
            'due_date' => ['required', 'date', 'after:start_date'],
            'city_from' => ['required', 'exists:cities,id'],
            'city_to' => ['required', 'exists:cities,id', Rule::notIn([$this->city_from])],
        ];
    }
}
