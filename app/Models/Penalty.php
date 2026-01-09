<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_log_id',
        'reason',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function parkingLog(): BelongsTo
    {
        return $this->belongsTo(ParkingLog::class);
    }
}
