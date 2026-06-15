<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Sistem Pakar')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar no-print">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">SP</span>
            <span>Admin Pakar</span>
        </a>
        <div class="side-menu">
            <a class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="side-link {{ request()->routeIs('admin.gejala.*') ? 'active' : '' }}" href="{{ route('admin.gejala.index') }}">Data Gejala</a>
            <a class="side-link {{ request()->routeIs('admin.kerusakan.*') ? 'active' : '' }}" href="{{ route('admin.kerusakan.index') }}">Data Kerusakan</a>
            <a class="side-link {{ request()->routeIs('admin.rule.*') ? 'active' : '' }}" href="{{ route('admin.rule.index') }}">Rule & CF</a>
            <a class="side-link {{ request()->routeIs('admin.konsultasi.*') ? 'active' : '' }}" href="{{ route('admin.konsultasi.index') }}">Riwayat</a>
            <a class="side-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">Laporan</a>
            <a class="side-link" href="{{ route('home') }}">Lihat Website</a>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="side-link" style="width:100%;border:0;background:transparent;cursor:pointer;text-align:left">Logout</button>
            </form>
        </div>
    </aside>
    <main class="admin-main">
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        @if($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif
        @yield('content')
    </main>
</div>
</body>
</html>
