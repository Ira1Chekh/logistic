<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fuel_price' => ['required', 'numeric', 'min:1', 'max:9999999'],
            'tax_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'enterprise_percent' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
