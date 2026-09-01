<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar - ShellSeek</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="auth-body">

<div class="auth-card">
    <div class="brand-mark"><span class="dot"></span>ShellSeek</div>
    <div class="brand-sub" style="margin-bottom:24px;">buat akun baru</div>

    @if ($errors->any())
        <div class="auth-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label class="auth-label">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" class="auth-input" required autofocus>

        <label class="auth-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" required>

        <label class="auth-label">Password</label>
        <input type="password" name="password" class="auth-input" required>

        <label class="auth-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="auth-input" required>

        <button type="submit" class="btn-run" style="width:100%; margin-top:8px;">Daftar</button>
    </form>

    <p class="auth-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
</div>

</body>
</html>