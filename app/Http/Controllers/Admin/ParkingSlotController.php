<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLot;
use App\Models\ParkingSlot;
use Illuminate\Http\Request;

class ParkingSlotController extends Controller
{
    public function create()
    {
        $lots = ParkingLot::query()->orderBy('name')->get();
        return view('admin.parking-slots.create', compact('lots'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parking_lot_id' => ['required', 'exists:parking_lots,id'],
            'slot_number' => ['required', 'string', 'max:50'],
            'status' => ['required', 'in:available,occupied,reserved,maintenance'],
        ]);

        ParkingSlot::create($data);

        return redirect()->route('dashboard')->with('status', 'Parking slot added');
    }
}
