<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,doc,docx,pdf', 'max:10240']
        ];
    }
}
