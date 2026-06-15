<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistem Pakar Laptop')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</head>
<body>
<div class="page">
    <nav class="navbar no-print">
        <div class="container nav-inner">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">SP</span>
                <span>Sistem Pakar Laptop</span>
            </a>
            <div class="nav-menu">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link {{ request()->routeIs('consultation.*') ? 'active' : '' }}" href="{{ route('consultation.create') }}">Konsultasi</a>
                <a class="nav-link" href="{{ route('admin.login') }}">Admin/Pakar</a>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="container" style="padding-top:18px"><div class="alert alert-success">{{ session('success') }}</div></div>
    @endif
    @if(session('error'))
        <div class="container" style="padding-top:18px"><div class="alert alert-error">{{ session('error') }}</div></div>
    @endif
    @if($errors->any())
        <div class="container" style="padding-top:18px"><div class="alert alert-error">{{ $errors->first() }}</div></div>
    @endif

    @yield('content')
</div>
</body>
</html>
