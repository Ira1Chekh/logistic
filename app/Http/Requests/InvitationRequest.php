<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvitationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => ['required', Rule::in([UserRole::Driver, UserRole::Manager])],
            'email' => ['required', 'email']
        ];
    }
}
