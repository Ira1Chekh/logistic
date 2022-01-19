<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use Prunable, HasFactory;

    const PAGINATION = 10;

    protected $fillable = [
        'name',
        'status',
        'description',
        'cargo_weight',
        'price',
        'start_date',
        'due_date',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'start_date' => 'date',
        'due_date' => 'date',
    ];

    public function prunable()
    {
        return static::query()
            ->where('status', OrderStatus::Declined)
            ->whereMonth('created_at', '<=', Carbon::now()->subMonth()->month);
    }

    public function client(): BelongsTo
    {
       return $this->belongsTo(Client::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function cargoType(): BelongsTo
    {
        return $this->belongsTo(CargoType::class);
    }

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function cityFrom(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_from_id');
    }

    public function cityTo(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_to_id');
    }

    public function scopeFilteredList(Builder $query, User $user)
    {
        return $query
            ->when(
                $user->isClient(),
                fn () => $query->where('client_id', $user->id)
            )
            ->when(
                $user->isDriver(),
                fn () => $query->whereIn('status', [
                    OrderStatus::Paid,
                    OrderStatus::In_progress,
                    OrderStatus::Done]
                )
            );
    }

    public function isRequest(): bool
    {
        return $this->status->value === OrderStatus::Request;
    }

    public function isPending(): bool
    {
        return $this->status->value === OrderStatus::Pending;
    }

    public function isOwned(User $user): bool
    {
        return $this->client_id === $user->id;
    }

    public function isExecuted(User $user): bool
    {
        return $this->driver_id === $user->id;
    }
}
