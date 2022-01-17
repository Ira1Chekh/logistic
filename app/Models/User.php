<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Parental\HasChildren;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use function Illuminate\Events\queueable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia, HasDocuments, HasRole, HasChildren;

    const PAGINATION = 10;

    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected string $childColumn = 'role';

    protected array $childTypes = [
        UserRole::Manager => Manager::class,
        UserRole::Driver => Driver::class,
        UserRole::Client => Client::class,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRole::class,
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isManager(): bool
    {
        return $this->role->value === UserRole::Manager;
    }

    public function isClient(): bool
    {
        return $this->role->value === UserRole::Client;
    }

    public function isDriver(): bool
    {
        return $this->role->value === UserRole::Driver;
    }
}
