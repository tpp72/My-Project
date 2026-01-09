@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Password recovery</span>
                    <h1 class="h3 auth-title mb-2">Forgot password</h1>

                    <p class="auth-sub mb-4">
                        กรอกอีเมลที่ใช้สมัคร ระบบจะส่งลิงก์สำหรับตั้งรหัสผ่านใหม่ให้คุณ
                    </p>

                    <div class="small text-muted2">
                        • ใช้อีเมลเดียวกับตอนสมัครสมาชิก<br>
                        • ลิงก์จะมีอายุจำกัดเพื่อความปลอดภัย
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        จำรหัสผ่านได้แล้ว?
                        <a class="auth-link" href="{{ route('login') }}">กลับไป Login</a>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">

                    @if (session('status'))
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">ส่งลิงก์แล้ว</div>
                            <div class="small">{{ session('status') }}</div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">เกิดข้อผิดพลาด</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="mt-2">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                placeholder="you@example.com" required autofocus>
                            <div class="form-text">
                                ระบบจะส่งลิงก์รีเซ็ตรหัสผ่านไปที่อีเมลนี้
                            </div>
                        </div>

                        <button type="submit" class="btn btn-red btn-lg w-100">
                            Send reset link
                        </button>

                        <div class="text-center mt-3 text-muted2 small">
                            ยังไม่มีบัญชี?
                            <a class="auth-link" href="{{ route('register') }}">สมัครสมาชิก</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
