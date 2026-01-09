<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLog;

class ParkingLogController extends Controller
{
    public function index()
    {
        $logs = ParkingLog::query()
            ->latest()
            ->paginate(20);

        return view('admin.parking-logs.index', compact('logs'));
    }
}
