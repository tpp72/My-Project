@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="page-title">
            <div>
                <div class="text-muted2 small">Admin</div>
                <h1 class="h4 mb-0">Dashboard Overview</h1>
            </div>

            <div class="d-flex gap-2 quick-actions">
                <a class="btn btn-outline-light" href="{{ route('admin.parking-lots.create') }}">Create Lot</a>
                <a class="btn btn-outline-light" href="{{ route('admin.parking-slots.create') }}">Add Slot</a>
                <a class="btn btn-red" href="{{ route('admin.parking-logs.index') }}">View Logs</a>
            </div>
        </div>

        {{-- KPI --}}
        <div class="row g-3 kpi-grid mb-3">
            <div class="col-6 col-lg-3">
                <div class="kpi">
                    <div class="kpi-label">Revenue Today</div>
                    <div class="kpi-value">{{ number_format($revenueToday, 2) }}</div>
                    <div class="kpi-trend">paid only</div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi">
                    <div class="kpi-label">Parking Lots</div>
                    <div class="kpi-value">{{ $totalLots }}</div>
                    <div class="kpi-trend">ทั้งหมดในระบบ</div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi">
                    <div class="kpi-label">Parking Logs</div>
                    <div class="kpi-value">{{ $totalLogs }}</div>
                    <div class="kpi-trend">รายการเข้า-ออก</div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi">
                    <div class="kpi-label">Alerts</div>
                    <div class="kpi-value">{{ $totalAlerts }}</div>
                    <div class="kpi-trend">
                        <span class="badge badge-soft-red rounded-pill">เฝ้าระวัง</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-3">
            {{-- Weekly Chart --}}
            <div class="col-lg-7">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Weekly Revenue (Last 7 Days)</h2>
                        <span class="text-muted2 small">paid only</span>
                    </div>
                    <div class="section-body">
                        <canvas id="weeklyRevenueChart" height="110"></canvas>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="col-lg-5">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Quick Actions</h2>
                        <span class="text-muted2 small">Admin tools</span>
                    </div>
                    <div class="section-body">
                        <div class="d-grid gap-2">
                            <a class="btn btn-red" href="{{ route('admin.parking-lots.create') }}">Create Parking Lot</a>
                            <a class="btn btn-outline-light" href="{{ route('admin.parking-slots.create') }}">Add Parking
                                Slot</a>
                            <a class="btn btn-outline-light" href="{{ route('admin.parking-logs.index') }}">View Parking
                                Logs</a>
                        </div>

                        <hr class="hr-soft my-4">

                        <div class="mini-list">
                            <div class="mini-item">
                                <div class="fw-semibold">Recent Payments</div>
                                <div class="muted">แสดงล่าสุด 5 รายการด้านล่าง</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Logs + Payments --}}
        <div class="row g-3">
            <div class="col-lg-7">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Recent Parking Logs</h2>
                        <span class="text-muted2 small">ล่าสุด 5 รายการ</span>
                    </div>
                    <div class="section-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-darkish mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:110px">#</th>
                                        <th>Lot</th>
                                        <th>Vehicle</th>
                                        <th>Check-in</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentLogs as $log)
                                        <tr>
                                            <td class="fw-semibold">LOG-{{ $log->id }}</td>
                                            <td>{{ $log->parking_lot_id ?? '-' }}</td>
                                            <td>{{ $log->vehicle_id ?? '-' }}</td>
                                            <td class="text-muted2">{{ $log->check_in_time ?? $log->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-muted2 p-4">ยังไม่มีข้อมูล</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Recent Payments</h2>
                        <span class="text-muted2 small">ล่าสุด 5 รายการ</span>
                    </div>
                    <div class="section-body">
                        <div class="mini-list">
                            @forelse ($recentPayments as $pay)
                                <div class="mini-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="fw-semibold">PAY-{{ $pay->id }}</div>
                                        <span class="badge badge-soft-red rounded-pill">
                                            {{ $pay->payment_status ?? 'unpaid' }}
                                        </span>
                                    </div>
                                    <div class="muted mt-1">
                                        Amount: <b>{{ $pay->total_amount ?? '-' }}</b> • {{ $pay->created_at }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted2">ยังไม่มีข้อมูล</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($weekLabels);
        const values = @json($weekValues);

        const ctx = document.getElementById('weeklyRevenueChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Revenue',
                    data: values,
                    tension: 0.35,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#9aa4b2'
                        },
                        grid: {
                            color: 'rgba(255,255,255,.06)'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#9aa4b2'
                        },
                        grid: {
                            color: 'rgba(255,255,255,.06)'
                        }
                    }
                }
            }
        });
    </script>
@endpush
