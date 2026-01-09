@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Create account</span>
                    <h1 class="h3 auth-title mb-2">Register</h1>
                    <p class="auth-sub mb-4">
                        สมัครสมาชิกเพื่อเริ่มใช้งานระบบลานจอดรถอัจฉริยะ
                    </p>

                    <div class="small text-muted2">
                        สมัครแล้วจะสามารถ:<br>
                        • จองที่จอดล่วงหน้า<br>
                        • ดูประวัติการจอด/ชำระเงิน<br>
                        • รับการแจ้งเตือน
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        มีบัญชีอยู่แล้ว?
                        <a class="auth-link" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">
                    @if ($errors->any())
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">สมัครสมาชิกไม่สำเร็จ</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li class="small">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="mt-2">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required
                                autocomplete="name" placeholder="Your name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                                autocomplete="username" placeholder="you@example.com">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required
                                    autocomplete="new-password" placeholder="••••••••">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm password</label>
                                <input type="password" name="password_confirmation" class="form-control" required
                                    autocomplete="new-password" placeholder="••••••••">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-red btn-lg w-100 mt-4">
                            Create account
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
