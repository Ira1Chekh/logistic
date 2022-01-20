<?php

namespace Tests;

use App\Models\User;
use Laravel\Sanctum\Sanctum;

trait SignInAsDriver
{
    protected function signInAsDriver()
    {
        $driver = User::factory()->driver()->create();
        Sanctum::actingAs($driver, ['*']);

        return $driver;
    }
}
