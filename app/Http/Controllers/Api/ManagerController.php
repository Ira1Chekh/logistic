<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Http\Requests\InvitationRequest;
use App\Http\Resources\UserResource;
use App\Models\Manager;
use App\Models\User;
use App\Notifications\InviteUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Notification;

class ManagerController
{
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(
            Manager::query()->paginate(User::PAGINATION)
        );
    }

    public function invite(InvitationRequest $request): RedirectResponse
    {
        Notification::route('mail', $request->email)
            ->notify(new InviteUser(UserRole::Manager));

        return back()->with('message', 'Приглашение успешно отправлено!');
    }
}
