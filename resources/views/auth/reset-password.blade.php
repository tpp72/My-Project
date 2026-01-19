@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Reset password</span>
                    <h1 class="h3 auth-title mb-2">Set a new password</h1>

                    <p class="auth-sub mb-4">
                        ตั้งรหัสผ่านใหม่สำหรับบัญชีของคุณ แล้วเข้าสู่ระบบอีกครั้ง
                    </p>

                    <div class="small text-muted2">
                        • ควรตั้งรหัสผ่านยาวอย่างน้อย 8 ตัวอักษร<br>
                        • ผสมตัวอักษร+ตัวเลขเพื่อความปลอดภัย
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        กลับไป
                        <a class="auth-link" href="{{ route('login') }}">Login</a>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">
                    @if ($errors->any())
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">ตั้งรหัสผ่านไม่สำเร็จ</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}" class="mt-2">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control text-muted" value="{{ old('email', $request->email) }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New password</label>
                            <input type="password" name="password" class="form-control" required autocomplete="new-password"
                                placeholder="••••••••">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm password</label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                autocomplete="new-password" placeholder="••••••••">
                        </div>

                        <button type="submit" class="btn btn-red btn-lg w-100">Reset password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
