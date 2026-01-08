<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationLog extends Model
{
    protected $fillable = [
        'reservation_id',
        'status',
        'note',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
