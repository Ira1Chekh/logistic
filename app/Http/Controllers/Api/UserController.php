<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRoleRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(UserRoleRequest $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()
                ->where('role', $request->input('role'))
                ->paginate(User::PAGINATION)
        );
    }
}
