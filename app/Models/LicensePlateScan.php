<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicensePlateScan extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'license_plate',
        'image_path',
        'scan_time',
    ];

    protected $casts = [
        'scan_time' => 'datetime',
    ];

    public function device(): BelongsTo
    {
        return $this->belongsTo(EntryExitDevice::class, 'device_id');
    }
}
