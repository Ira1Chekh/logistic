<?php

namespace Tests;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait SignInAsManager
{
    protected function signInAsManager()
    {
        $manager = User::factory()->manager()->create();
        Sanctum::actingAs($manager, ['*']);

        return $manager;
    }
}
