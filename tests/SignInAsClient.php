<?php

namespace Tests;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait SignInAsClient
{
    protected function signInAsClient()
    {
        $client = User::factory()->client()->create();
        Sanctum::actingAs($client, ['*']);

        return $client;
    }
}
