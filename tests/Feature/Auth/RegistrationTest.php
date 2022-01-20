<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 'client',
            'password_confirmation' => 'password',
        ])->assertStatus(200);

        $this->assertAuthenticated();
    }
}
