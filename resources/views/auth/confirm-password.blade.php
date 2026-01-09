@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Security</span>
                    <h1 class="h3 auth-title mb-2">Confirm password</h1>

                    <p class="auth-sub mb-4">
                        เพื่อความปลอดภัย กรุณายืนยันรหัสผ่านก่อนทำรายการสำคัญ
                    </p>

                    <div class="small text-muted2">
                        ตัวอย่าง: เปลี่ยนอีเมล, แก้ข้อมูลสำคัญ, ลบบัญชี ฯลฯ
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        กลับไป <a class="auth-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">
                    @if ($errors->any())
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">ยืนยันไม่สำเร็จ</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}" class="mt-2">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required
                                autocomplete="current-password" placeholder="••••••••">
                            <div class="form-text">
                                กรุณากรอกรหัสผ่านปัจจุบันของคุณ
                            </div>
                        </div>

                        <button type="submit" class="btn btn-red btn-lg w-100">
                            Confirm
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
