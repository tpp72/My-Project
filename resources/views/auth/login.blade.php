@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Welcome back</span>
                    <h1 class="h3 auth-title mb-2">Login</h1>
                    <p class="auth-sub mb-4">
                        เข้าสู่ระบบเพื่อใช้งานในบทบาท <b>Admin</b> หรือ <b>User</b>
                    </p>

                    <div class="small text-muted2">
                        • Admin: จัดการลานจอด อุปกรณ์ รายงาน<br>
                        • User: จองที่จอด ดูประวัติ ชำระเงิน
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        ยังไม่มีบัญชี?
                        <a class="auth-link" href="{{ route('register') }}">สมัครสมาชิก</a>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">
                    @if ($errors->any())
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">ไม่สามารถเข้าสู่ระบบได้</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mt-2">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                autofocus autocomplete="username" placeholder="you@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required
                                autocomplete="current-password" placeholder="••••••••">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted2" for="remember">
                                    Remember me
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a class="auth-link small" href="{{ route('password.request') }}">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-red btn-lg w-100">
                            Sign in
                        </button>

                        <div class="text-center mt-3 text-muted2 small">
                            กลับหน้า <a class="auth-link" href="{{ route('home') }}">Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
