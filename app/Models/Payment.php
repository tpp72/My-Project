<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'parking_log_id',
        'reservation_id',
        'total_hours',
        'hourly_rate',
        'parking_fee',
        'reservation_discount',
        'total_amount',
        'payment_status',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function parkingLog()
    {
        return $this->belongsTo(ParkingLog::class);
    }
}
