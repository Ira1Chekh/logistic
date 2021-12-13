<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use phpDocumentor\Reflection\Types\Boolean;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia
{
    use InteractsWithMedia, HasDocuments;

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
        'start_at' => 'date',
        'due_date' => 'date',
    ];

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

    public function calculatePrice(City $cityFrom, City $cityTo, int $cargoWeight)
    {
        return City::calculateDistance($cityFrom, $cityTo) * $cargoWeight * 100;
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
                    OrderStatus::Paid(),
                    OrderStatus::In_progress(),
                    OrderStatus::Done()]
                )
            );
    }

    public function isRequest(): bool
    {
        return $this->status === OrderStatus::Request();
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
