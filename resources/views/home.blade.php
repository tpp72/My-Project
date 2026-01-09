<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Parking | Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                SmartParking<span class="brand-dot">.</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="topNav">
                <ul class="navbar-nav ms-auto gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="#dashboard">ภาพรวม</a></li>
                    <li class="nav-item"><a class="nav-link" href="#lots">ลานจอด</a></li>
                    <li class="nav-item"><a class="nav-link" href="#news">ประกาศ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#alerts">แจ้งเตือน</a></li>
                </ul>

                <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0">
                    {{-- ถ้าคุณใช้ Laravel Breeze/Fortify/Jetstream ปุ่มเหล่านี้จะไป route /login /register ได้ --}}
                    <a class="btn btn-outline-light" href="/login">Login</a>
                    <a class="btn btn-red" href="/register">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <div class="p-4 p-md-5 hero-card">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="badge badge-red rounded-pill mb-3">Admin + User • Dark/Red Theme</span>
                        <h1 class="display-6 fw-bold mb-2">Smart Parking System</h1>
                        <p class="text-muted2 mb-4">
                            ดูภาพรวมลานจอด ข่าวประกาศ และสัญญาณเตือนล่าสุดก่อนเข้าสู่ระบบ
                            (ข้อมูลดึงจากฐานข้อมูลจริง)
                        </p>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="/login" class="btn btn-red btn-lg">เข้าสู่ระบบ</a>
                            <a href="/register" class="btn btn-outline-light btn-lg">สร้างบัญชี</a>
                            <a href="#dashboard" class="btn btn-link text-decoration-none text-light">ดูข้อมูลภาพรวม
                                ↓</a>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="kpi-card p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="fw-semibold">Quick Overview</div>
                                <div class="small text-muted2">อัปเดตจาก DB</div>
                            </div>

                            <div class="row g-3" id="dashboard">
                                <div class="col-6">
                                    <div class="p-3 rounded-3 border" style="border-color: var(--border)!important;">
                                        <div class="small text-muted2">Parking Lots</div>
                                        <div class="h3 fw-bold mb-0">{{ $stats['lots'] }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded-3 border" style="border-color: var(--border)!important;">
                                        <div class="small text-muted2">Devices</div>
                                        <div class="h3 fw-bold mb-0">{{ $stats['devices'] }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded-3 border" style="border-color: var(--border)!important;">
                                        <div class="small text-muted2">Parking Logs</div>
                                        <div class="h3 fw-bold mb-0">{{ $stats['logs'] }}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded-3 border" style="border-color: var(--border)!important;">
                                        <div class="small text-muted2">Suspicious</div>
                                        <div class="h3 fw-bold mb-0">{{ $stats['alerts'] }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="small text-muted2 mt-3">
                                Admin: ตรวจสอบอุปกรณ์/สัญญาณเตือน • User: ดูประกาศ/ข้อมูลลานจอด
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">

        {{-- Parking lots --}}
        <section class="mt-4" id="lots">
            <div class="d-flex justify-content-between align-items-end mb-2">
                <h2 class="h5 fw-bold mb-0">ลานจอดล่าสุด</h2>
                <span class="text-muted2 small">ดึงจากตาราง parking_lots</span>
            </div>

            <div class="row g-3">
                @forelse($lots as $lot)
                    <div class="col-md-4">
                        <div class="data-card p-4 h-100">
                            <div class="d-flex justify-content-between">
                                <div class="fw-semibold">{{ $lot->name }}</div>
                                <span class="badge badge-red rounded-pill">฿
                                    {{ number_format((float) $lot->hourly_rate, 2) }}/hr</span>
                            </div>
                            <div class="text-muted2 small mt-2">
                                {{ $lot->location ?? '—' }}
                            </div>
                            <hr style="border-color: var(--border);">
                            <div class="d-flex justify-content-between small">
                                <span class="text-muted2">Total Slots</span>
                                <span class="fw-semibold">{{ $lot->total_slots }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="data-card p-4">ยังไม่มีข้อมูลลานจอด</div>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Announcements --}}
        <section class="mt-5" id="news">
            <div class="d-flex justify-content-between align-items-end mb-2">
                <h2 class="h5 fw-bold mb-0">ประกาศล่าสุด</h2>
                <span class="text-muted2 small">ดึงจากตาราง posts</span>
            </div>

            <div class="row g-3">
                @forelse($posts as $post)
                    <div class="col-md-4">
                        <div class="data-card p-4 h-100">
                            <div class="fw-semibold">{{ $post->title }}</div>
                            <div class="text-muted2 small mt-2 line-clamp-2">
                                {{ $post->content }}
                            </div>
                            <div class="text-muted2 small mt-3">
                                {{ optional($post->created_at)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="data-card p-4">ยังไม่มีประกาศ</div>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Alerts & Notifications --}}
        <section class="mt-5" id="alerts">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="data-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <h3 class="h6 fw-bold mb-0">รถต้องสงสัยล่าสุด</h3>
                            <span class="text-muted2 small">suspicious_vehicles</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-darkish table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Plate</th>
                                        <th>Brand</th>
                                        <th>Color</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($suspicious as $sv)
                                        <tr>
                                            <td class="fw-semibold">{{ $sv->license_plate }}</td>
                                            <td>{{ $sv->brand ?? '—' }}</td>
                                            <td>{{ $sv->color ?? '—' }}</td>
                                            <td class="text-muted2">
                                                {{ \Illuminate\Support\Str::limit($sv->reason, 40) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-muted2">ยังไม่มีข้อมูล</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="text-muted2 small mt-3">
                            * หน้า Login แล้วค่อยแสดงรายละเอียด/สิทธิ์ตาม Role
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-end mb-2">
                            <h3 class="h6 fw-bold mb-0">Notifications ล่าสุด</h3>
                            <span class="text-muted2 small">notifications</span>
                        </div>

                        <div class="list-group list-group-flush">
                            @forelse($latestNotifications as $n)
                                <div class="list-group-item bg-transparent text-light border-0 px-0">
                                    <div class="d-flex justify-content-between">
                                        <div class="fw-semibold">
                                            {{ $n->title }}
                                            @if (!$n->is_read)
                                                <span class="badge badge-red rounded-pill ms-2">new</span>
                                            @endif
                                        </div>
                                        <div class="text-muted2 small">
                                            {{ optional($n->created_at)->format('d/m H:i') }}</div>
                                    </div>
                                    <div class="text-muted2 small mt-1">
                                        {{ \Illuminate\Support\Str::limit($n->message, 70) }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted2">ยังไม่มี notifications</div>
                            @endforelse
                        </div>

                        <div class="mt-3 d-flex gap-2">
                            <a href="/login" class="btn btn-red">Login เพื่อดูของฉัน</a>
                            <a href="/register" class="btn btn-outline-light">สมัครสมาชิก</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="container d-flex flex-wrap justify-content-center gap-2">
            <div>© {{ date('Y') }} Smart-Parking • By tpp72</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
