<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Notifications\InviteUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class InviteUserController extends Controller
{
    public function __invoke(InvitationRequest $request): RedirectResponse
    {
        Notification::route('mail', $request->email)
            ->notify(new InviteUser($request->role));

        return back()->with('Приглашение успешно отправлено!');
    }
}
