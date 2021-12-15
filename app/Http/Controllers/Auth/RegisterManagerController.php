<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;

class RegisterManagerController extends RegisteredUserController
{
    public function create()
    {
        return view('auth.register-manager');
    }

    protected function createUser(RegisterRequest $request)
    {
        return Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
