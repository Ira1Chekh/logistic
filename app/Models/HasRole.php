<?php

namespace App\Models;

use App\Enums\UserRole;

trait HasRole
{
    public function hasRole(UserRole $role): bool
    {
        return $this->role->is($role);
    }

    public function assignRole(UserRole $role)
    {
        $this->role = $role;
    }
}
