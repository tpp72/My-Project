@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 style="color:#fff">DASHBOARD VIEW LOADED</h1>
    </div>
    <div class="container">

        <div class="page-title">
            <div>
                <div class="text-muted2 small">User</div>
                <h1 class="h4 mb-0">My Dashboard</h1>
            </div>

            <div class="d-flex gap-2 quick-actions">
                <a href="{{ route('home') }}" class="btn btn-outline-light">Home</a>
                <a href="{{ route('profile.edit') }}" class="btn btn-red">Profile</a>
            </div>
        </div>

        <div class="row g-3 mb-3 kpi-grid">
            <div class="col-6 col-lg-4">
                <div class="kpi">
                    <div class="kpi-label">My Vehicles</div>
                    <div class="kpi-value">{{ $myVehicles->count() }}</div>
                    <div class="kpi-trend">รถของฉัน</div>
                </div>
            </div>

            <div class="col-6 col-lg-4">
                <div class="kpi">
                    <div class="kpi-label">Recent Reservations</div>
                    <div class="kpi-value">{{ $myReservations->count() }}</div>
                    <div class="kpi-trend">ล่าสุด 5 รายการ</div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="kpi">
                    <div class="kpi-label">Unread Notifications</div>
                    <div class="kpi-value">{{ $unreadNotifications->count() }}</div>
                    <div class="kpi-trend">
                        <span class="badge badge-soft-red rounded-pill">แจ้งเตือนใหม่</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            {{-- Vehicles --}}
            <div class="col-lg-4">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">My Vehicles</h2>
                        <span class="text-muted2 small">ทะเบียนรถ</span>
                    </div>
                    <div class="section-body">
                        <div class="mini-list">
                            @forelse ($myVehicles as $v)
                                <div class="mini-item">
                                    <div class="fw-semibold">{{ $v->license_plate }}</div>
                                    <div class="muted">Brand: {{ $v->brand ?? '-' }} • Color: {{ $v->color ?? '-' }}</div>
                                </div>
                            @empty
                                <div class="text-muted2">ยังไม่มีรถในระบบ</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reservations --}}
            <div class="col-lg-5">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Recent Reservations</h2>
                        <span class="text-muted2 small">ล่าสุด 5 รายการ</span>
                    </div>

                    <div class="section-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-darkish mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:110px">#</th>
                                        <th>Status</th>
                                        <th>Start</th>
                                        <th>End</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($myReservations as $r)
                                        <tr>
                                            <td class="fw-semibold">RSV-{{ $r->id }}</td>
                                            <td>
                                                <span class="badge badge-soft-red rounded-pill">
                                                    {{ $r->status ?? 'pending' }}
                                                </span>
                                            </td>
                                            <td class="text-muted2">{{ $r->reserve_start ?? '-' }}</td>
                                            <td class="text-muted2">{{ $r->reserve_end ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-muted2 p-4">ยังไม่มีการจอง</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Notifications --}}
            <div class="col-lg-3">
                <div class="section-card">
                    <div class="section-head">
                        <h2 class="section-title">Notifications</h2>
                        <span class="text-muted2 small">Unread</span>
                    </div>
                    <div class="section-body">
                        <div class="mini-list">
                            @forelse ($unreadNotifications as $n)
                                <div class="mini-item">
                                    <div class="fw-semibold">{{ $n->title }}</div>
                                    <div class="muted">{{ $n->created_at }}</div>
                                </div>
                            @empty
                                <div class="text-muted2">ไม่มีแจ้งเตือนใหม่</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
