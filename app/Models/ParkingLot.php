<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingLot extends Model
{
    protected $fillable = [
        'name',
        'location',
        'total_slots',
        'hourly_rate',
    ];

    public function parkingRates()
    {
        return $this->hasMany(\App\Models\ParkingRate::class);
    }

    public function entryExitDevices()
    {
        return $this->hasMany(\App\Models\EntryExitDevice::class);
    }
}
