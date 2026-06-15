<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin Pakar</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
<div class="login-page">
    <form class="login-card" method="POST" action="{{ route('admin.login.process') }}">
        @csrf
        <div class="brand" style="margin-bottom:22px"><span class="brand-mark">SP</span><span>Admin Sistem Pakar</span></div>
        <h1 style="margin:0 0 8px">Login Pakar</h1>
        <p style="color:var(--muted);margin-top:0">Kelola gejala, kerusakan, rule, nilai CF, dan riwayat konsultasi.</p>
        @if(session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        @if($errors->any()) <div class="alert alert-error">{{ $errors->first() }}</div> @endif
        <div class="form-group">
            <label class="label">Email</label>
            <input class="input" name="email" type="email" value="{{ old('email', 'admin@sistempakar.test') }}" required>
        </div>
        <div class="form-group">
            <label class="label">Password</label>
            <input class="input" name="password" type="password" value="password" required>
        </div>
        <button class="btn btn-primary btn-block">Masuk Dashboard</button>
        <p style="margin-bottom:0;color:var(--muted);font-size:13px">Default: admin@sistempakar.test / password</p>
    </form>
</div>
</body>
</html>
