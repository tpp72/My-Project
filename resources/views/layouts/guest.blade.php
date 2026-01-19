<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SmartParking' }}</title>
    <link rel="icon" href="{{ asset('favicon.ico?v=2') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                SmartParking<span class="brand-dot">.</span>
            </a>

            <div class="ms-auto d-flex gap-2">
                @auth
                    <a class="btn btn-outline-light" href="{{ route('dashboard') }}">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button class="btn btn-red" type="submit">Logout</button>
                    </form>
                @else
                    <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                    <a class="btn btn-red" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer mt-auto">
        <div class="container d-flex flex-wrap justify-content-center gap-2">
            <div>© {{ date('Y') }} Smart-Parking</div>
            <div class="text-muted2">Secure access for Admin + User</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
