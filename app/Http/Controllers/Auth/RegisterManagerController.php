<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterManagerController extends RegisteredUserController
{
    protected function createUser(RegisterRequest $request)
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role' => UserRole::Manager,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
