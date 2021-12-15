<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->createUser($request);

        //event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    protected function createUser(RegisterRequest $request)
    {
        return Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
