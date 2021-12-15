<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            Client::query()->paginate(User::PAGINATION)
        );
    }
}
