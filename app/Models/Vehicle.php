<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'license_plate',
        'brand',
        'color',
    ];

    /**
     * เจ้าของรถ
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ประวัติการจอด (เข้า–ออก)
     */
    public function parkingLogs()
    {
        return $this->hasMany(ParkingLog::class);
    }

    /**
     * การจองที่จอด
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
