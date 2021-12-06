<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'role' => UserRole::getRandomValue(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function mainManager()
    {
        return $this->state(function (array $attributes) {
            return [
                'first_name' => config('auth.manager.first_name'),
                'last_name' => config('auth.manager.last_name'),
                'email' => config('auth.manager.email'),
                'role' => UserRole::Manager(),
            ];
        });
    }
}
