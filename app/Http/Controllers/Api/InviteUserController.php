<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvitationRequest;
use App\Notifications\InviteUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use function back;

class InviteUserController extends Controller
{
    public function __invoke(InvitationRequest $request): RedirectResponse
    {
        Notification::route('mail', $request->email)
            ->notify(new InviteUser($request->role));

        return back()->with('message', 'Приглашение успешно отправлено!');
    }
}
