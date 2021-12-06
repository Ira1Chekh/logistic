<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia
{
    use InteractsWithMedia, HasDocuments;

    protected $fillable = [
        'name',
        'description',
        'cargo_weight',
        'price',
        'start_date',
        'due_date'
    ];

    protected $casts = [
        'status' => ProjectStatus::class,
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
}
