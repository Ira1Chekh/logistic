<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;

interface CanRegister
{
    public function create();

    public function store(RegisterRequest $request);
}
