<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Parental\HasParent;

class Client extends User
{
    use HasParent;

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
