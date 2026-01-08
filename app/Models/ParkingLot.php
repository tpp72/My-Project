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
}
