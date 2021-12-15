<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Requests\InvitationRequest;
use App\Http\Resources\UserResource;
use App\Models\Driver;
use App\Models\User;
use App\Notifications\InviteUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Notification;

class DriverController
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            Driver::query()->paginate(User::PAGINATION)
        );
    }

    public function invite(InvitationRequest $request): RedirectResponse
    {
        Notification::route('mail', $request->email)
            ->notify(new InviteUser(UserRole::Driver));

        return back()->with('message', 'Приглашение успешно отправлено!');
    }
}
