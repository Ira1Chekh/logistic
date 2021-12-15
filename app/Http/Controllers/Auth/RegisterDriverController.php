<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class RegisterDriverController extends RegisteredUserController
{
    public function create()
    {
        return view('auth.register-driver');
    }

    protected function createUser(RegisterRequest $request)
    {
        return Driver::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
