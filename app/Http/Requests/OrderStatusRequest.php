<?php

namespace App\Http\Requests;

use App\Rules\OrderStatusRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => ['required', new OrderStatusRule($this->route('order'), $this->user())],
        ];
    }
}
