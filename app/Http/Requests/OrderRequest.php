<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'cargo_weight' => ['required', 'string'],
            'cargo_type' => ['required', 'exists:cargo_types:id'],
            'vehicle_type' => ['required', 'exists:vehicle_types:id'],
            'start_date' => ['required'],
            'due_date' => ['required'],
            'city_from' => ['required', 'exists:cities,id'],
            'city_to' => ['required', 'exists:cities,id', Rule::notIn([$this->city_from])]
        ];
    }
}
