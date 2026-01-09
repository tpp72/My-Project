<?php

namespace App\Http\Controllers;

use App\Models\ParkingLot;
use App\Models\Post;
use App\Models\Notification;
use App\Models\SuspiciousVehicle;
use App\Models\EntryExitDevice;
use App\Models\ParkingLog;

class HomeController extends Controller
{
    public function index()
    {
        // สรุปตัวเลข (สำหรับโชว์บนหน้าแรก)
        $stats = [
            'lots' => ParkingLot::count(),
            'devices' => EntryExitDevice::count(),
            'logs' => ParkingLog::count(),
            'alerts' => SuspiciousVehicle::count(),
            'announcements' => Post::count(),
        ];

        // ลานจอดล่าสุด
        $lots = ParkingLot::query()
            ->select(['id', 'name', 'location', 'total_slots', 'hourly_rate'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        // ข่าวประกาศล่าสุด
        $posts = Post::query()
            ->select(['id', 'title', 'content', 'created_at'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        // แจ้งเตือนล่าสุด (เป็น “ตัวอย่างระบบ” ก่อน login)
        $latestNotifications = Notification::query()
            ->select(['id', 'title', 'message', 'is_read', 'created_at'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        // รถต้องสงสัยล่าสุด
        $suspicious = SuspiciousVehicle::query()
            ->select(['id', 'license_plate', 'brand', 'color', 'reason', 'created_at'])
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('stats', 'lots', 'posts', 'latestNotifications', 'suspicious'));
    }
}
