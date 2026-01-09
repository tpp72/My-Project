<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntryExitDevice extends Model
{
    use HasFactory;

    public const TYPE_GATE = 'gate';
    public const TYPE_CAMERA = 'camera';
    public const TYPE_SCANNER = 'scanner';

    public const STATUS_ONLINE = 'online';
    public const STATUS_OFFLINE = 'offline';


    protected $fillable = [
        'parking_lot_id',
        'device_type',
        'location',
        'status',
    ];

    protected $casts = [
        'device_type' => 'string',
        'status' => 'string',
    ];

    public function parkingLot(): BelongsTo
    {
        return $this->belongsTo(ParkingLot::class);
    }

    public function licensePlateScans()
    {
        return $this->hasMany(\App\Models\LicensePlateScan::class, 'device_id');
    }
}
