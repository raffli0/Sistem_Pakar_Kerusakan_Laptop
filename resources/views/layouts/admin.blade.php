<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Sistem Pakar')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar no-print">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="12" rx="2" />
                    <path d="M2 20h20" />
                    <path d="M9 10l2 2 4-4" />
                </svg>
            </span>
            <span>Admin Pakar</span>
        </a>
        <div class="side-menu">
            <a class="side-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="side-link {{ request()->routeIs('admin.gejala.*') ? 'active' : '' }}" href="{{ route('admin.gejala.index') }}">Data Gejala</a>
            <a class="side-link {{ request()->routeIs('admin.kerusakan.*') ? 'active' : '' }}" href="{{ route('admin.kerusakan.index') }}">Data Kerusakan</a>
            <a class="side-link {{ request()->routeIs('admin.rule.*') ? 'active' : '' }}" href="{{ route('admin.rule.index') }}">Rule & CF</a>
            <a class="side-link {{ request()->routeIs('admin.konsultasi.*') ? 'active' : '' }}" href="{{ route('admin.konsultasi.index') }}">Riwayat</a>
            <a class="side-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">Laporan</a>
            <a class="side-link" href="{{ route('home') }}" target="_blank">Lihat Website ↗</a>
            <form method="POST" action="{{ route('admin.logout') }}" data-confirm="Apakah Anda yakin ingin logout dari panel admin?">
                @csrf
                <button class="side-link side-link-danger" style="width:100%;border:0;background:transparent;cursor:pointer;text-align:left">Logout ➜</button>
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
