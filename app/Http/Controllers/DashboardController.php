<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Admin data
use App\Models\ParkingLot;
use App\Models\ParkingLog;
use App\Models\Payment;
use App\Models\SuspiciousVehicle;

// User data
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Notification;

class DashboardController extends Controller
{
    /**
     * Dashboard หลัง login
     * - admin → admin dashboard
     * - user  → user dashboard
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // ป้องกัน edge case
        if (!$user) {
            abort(403);
        }

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->userDashboard($user);
    }

    /**
     * Admin Dashboard
     */
    protected function adminDashboard()
    {
        $today = now()->toDateString();

        // รายได้วันนี้ (paid เท่านั้น)
        $revenueToday = Payment::query()
            ->where('payment_status', 'paid')
            ->whereDate('created_at', $today)
            ->sum('total_amount');

        // 7 วันล่าสุด (รวมยอดรายวัน)
        $rows = Payment::query()
            ->selectRaw("DATE(created_at) as day, COALESCE(SUM(total_amount),0) as total")
            ->where('payment_status', 'paid')
            ->whereDate('created_at', '>=', now()->subDays(6)->toDateString())
            ->groupByRaw("DATE(created_at)")
            ->orderByRaw("DATE(created_at)")
            ->get();

        // เติมวันที่ที่ไม่มีรายการให้เป็น 0
        $labels = [];
        $values = [];
        for ($i = 6; $i >= 0; $i--) {
            $d = now()->subDays($i)->toDateString();
            $labels[] = $d;
            $match = $rows->firstWhere('day', $d);
            $values[] = $match ? (float)$match->total : 0.0;
        }

        $data = [
            'totalLots'        => ParkingLot::count(),
            'totalLogs'        => ParkingLog::count(),
            'totalPayments'    => Payment::count(),
            'totalAlerts'      => SuspiciousVehicle::count(),

            'revenueToday'     => (float) $revenueToday,
            'weekLabels'       => $labels,
            'weekValues'       => $values,

            'recentLogs' => ParkingLog::query()->latest()->limit(5)->get(),
            'recentPayments' => Payment::query()->latest()->limit(5)->get(),
        ];

        return view('dashboard.admin', $data);
    }


    /**
     * User Dashboard
     */
    protected function userDashboard($user)
    {
        $data = [
            'myVehicles' => Vehicle::query()
                ->where('user_id', $user->id)
                ->get(),

            'myReservations' => Reservation::query()
                ->where('user_id', $user->id)
                ->latest()
                ->limit(5)
                ->get(),

            'unreadNotifications' => Notification::query()
                ->where('user_id', $user->id)
                ->where('is_read', false)
                ->latest()
                ->limit(5)
                ->get(),
        ];

        return view('dashboard.user', $data);
    }
}
