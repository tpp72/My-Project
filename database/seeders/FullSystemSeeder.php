<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Post;
use App\Models\Role;
use App\Models\Permission;
use App\Models\ParkingLot;
use App\Models\ParkingSlot;
use App\Models\ParkingRate;
use App\Models\EntryExitDevice;
use App\Models\Vehicle;
use App\Models\LicensePlateScan;
use App\Models\ParkingLog;
use App\Models\Penalty;
use App\Models\Reservation;
use App\Models\ReservationLog;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\SuspiciousVehicle;
use App\Models\AdminAction;

class FullSystemSeeder extends Seeder
{
    public function run(): void
    {
        /** --------------------
         * 1) USERS
         * -------------------- */
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => Hash::make('password')]
        );

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'User', 'password' => Hash::make('password')]
        );

        /** --------------------
         * 2) ROLES / PERMISSIONS
         * -------------------- */
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        Permission::firstOrCreate(['name' => 'manage_parking']);
        Permission::firstOrCreate(['name' => 'issue_penalty']);

        /** --------------------
         * 3) PARKING LOT
         * -------------------- */
        $lot = ParkingLot::create([
            'name' => 'Central Lot',
            'location' => 'Bangkok',
            'total_slots' => 10,
            'hourly_rate' => 40,
        ]);

        /** --------------------
         * 4) PARKING SLOTS
         * -------------------- */
        $slots = collect();
        foreach (range(1, 5) as $i) {
            $slots->push(
                ParkingSlot::create([
                    'parking_lot_id' => $lot->id,
                    'slot_number' => 'A' . $i,
                    'status' => 'available',
                ])
            );
        }

        /** --------------------
         * 5) PARKING RATES
         * -------------------- */
        ParkingRate::create([
            'parking_lot_id' => $lot->id,
            'start_hour' => 0,
            'end_hour' => 6,
            'rate' => 20,
        ]);

        ParkingRate::create([
            'parking_lot_id' => $lot->id,
            'start_hour' => 6,
            'end_hour' => 18,
            'rate' => 40,
        ]);

        /** --------------------
         * 6) DEVICES
         * -------------------- */
        $camera = EntryExitDevice::create([
            'parking_lot_id' => $lot->id,
            'device_type' => EntryExitDevice::TYPE_CAMERA,
            'location' => 'Entrance',
            'status' => EntryExitDevice::STATUS_ONLINE,
        ]);

        /** --------------------
         * 7) VEHICLE
         * -------------------- */
        $vehicle = Vehicle::create([
            'license_plate' => '1กก1234',
            'brand' => 'Toyota',
            'color' => 'White',
            'user_id' => $user->id,
        ]);

        /** --------------------
         * 8) LICENSE PLATE SCAN
         * -------------------- */
        LicensePlateScan::create([
            'device_id' => $camera->id,
            'license_plate' => '1กก1234',
            'scan_time' => now()->subMinutes(10),
        ]);

        /** --------------------
         * 9) PARKING LOG
         * -------------------- */
        $log = ParkingLog::create([
            'vehicle_id' => $vehicle->id,
            'parking_lot_id' => $lot->id,
            'parking_slot_id' => $slots->first()->id,
            'check_in_time' => now()->subHours(2),
        ]);

        /** --------------------
         * 10) PENALTY
         * -------------------- */
        Penalty::create([
            'parking_log_id' => $log->id,
            'reason' => 'จอดเกินเวลา',
            'amount' => 200,
        ]);

        /** --------------------
         * 11) RESERVATION
         * -------------------- */
        $reservation = Reservation::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'parking_lot_id' => $lot->id,
            'parking_slot_id' => $slots->last()->id,
            'reserve_start' => now()->addHour(),
            'reserve_end' => now()->addHours(3),
            'reservation_fee' => 50,
            'status' => 'pending',
        ]);

        ReservationLog::create([
            'reservation_id' => $reservation->id,
            'old_status' => 'pending',
            'new_status' => 'approved',
            'changed_by' => $admin->id,
        ]);

        /** --------------------
         * 12) PAYMENT
         * -------------------- */
        Payment::create([
            'parking_log_id' => $log->id,
            'reservation_id' => $reservation->id,
            'total_hours' => 2,
            'hourly_rate' => 40,
            'parking_fee' => 80,
            'reservation_discount' => 10,
            'total_amount' => 70,
            'payment_status' => 'paid',
        ]);

        /** --------------------
         * 13) NOTIFICATION
         * -------------------- */
        Notification::create([
            'user_id' => $user->id,
            'title' => 'ชำระเงินสำเร็จ',
            'message' => 'คุณชำระค่าจอดรถเรียบร้อยแล้ว',
            'is_read' => false,
        ]);

        /** --------------------
         * 14) SUSPICIOUS VEHICLE
         * -------------------- */
        SuspiciousVehicle::create([
            'license_plate' => '9ขข9999',
            'brand' => 'Honda',
            'color' => 'Black',
            'reason' => 'เข้าออกผิดปกติ',
            'added_by' => $admin->id,
        ]);

        /** --------------------
         * 15) POSTS
         * -------------------- */
        Post::create([
            'title' => 'เปิดใช้งานระบบ',
            'content' => 'ระบบลานจอดรถอัจฉริยะเปิดใช้งานแล้ว',
        ]);

        /** --------------------
         * 16) ADMIN ACTION LOG
         * -------------------- */
        AdminAction::create([
            'admin_id' => $admin->id,
            'action' => 'seed',
            'target_table' => 'system',
            'target_id' => null,
        ]);
    }
}
