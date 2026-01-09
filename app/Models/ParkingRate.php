<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_lot_id',
        'start_hour',
        'end_hour',
        'rate',
    ];

    protected $casts = [
        'start_hour' => 'integer',
        'end_hour' => 'integer',
        'rate' => 'decimal:2',
    ];

    public function parkingLot(): BelongsTo
    {
        return $this->belongsTo(ParkingLot::class);
    }
}
