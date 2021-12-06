<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Parental\HasParent;

class Driver extends User
{
    use HasParent;

    public function assignedOrders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
