@extends('layouts.guest')

@section('content')
    <div class="container auth-wrap">
        <div class="auth-card">
            <div class="auth-panel row g-0">
                <div class="col-lg-5 auth-left">
                    <span class="badge badge-red rounded-pill mb-3">Email verification</span>
                    <h1 class="h3 auth-title mb-2">Verify your email</h1>

                    <p class="auth-sub mb-4">
                        กรุณายืนยันอีเมลเพื่อเปิดใช้งานบัญชีและเข้าถึง Dashboard
                    </p>

                    <div class="small text-muted2">
                        • ระบบได้ส่งอีเมลยืนยันไปแล้ว<br>
                        • หากไม่พบ ให้ตรวจ spam/junk
                    </div>

                    <hr class="hr-soft my-4">

                    <div class="small text-muted2">
                        ต้องการออกจากระบบ?
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link auth-link p-0 align-baseline">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-7 auth-right">
                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-auth mb-3">
                            <div class="fw-semibold mb-1">ส่งลิงก์ยืนยันแล้ว</div>
                            <div class="small">กรุณาตรวจอีเมลของคุณ แล้วคลิกลิงก์เพื่อยืนยัน</div>
                        </div>
                    @endif

                    <div class="data-card p-4 mb-3">
                        <div class="fw-semibold mb-1">ยังไม่ได้รับอีเมล?</div>
                        <div class="text-muted2 small">
                            กดปุ่มด้านล่างเพื่อส่งลิงก์ยืนยันอีเมลใหม่อีกครั้ง
                        </div>
                    </div>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-red btn-lg w-100">
                            Resend verification email
                        </button>
                    </form>

                    <div class="text-center mt-3 text-muted2 small">
                        กลับหน้า <a class="auth-link" href="{{ route('home') }}">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
