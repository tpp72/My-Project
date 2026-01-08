<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingLog extends Model
{
    protected $fillable = [
        'vehicle_id',
        'parking_slot_id',
        'entry_time',
        'exit_time',
        'status',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
