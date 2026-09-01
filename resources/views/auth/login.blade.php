<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - ShellSeek</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="auth-body">

<div class="auth-card">
    <div class="brand-mark"><span class="dot"></span>ShellSeek</div>
    <div class="brand-sub" style="margin-bottom:24px;">masuk ke akunmu</div>

    @if ($errors->any())
        <div class="auth-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label class="auth-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="auth-input" required autofocus>

        <label class="auth-label">Password</label>
        <input type="password" name="password" class="auth-input" required>

        <button type="submit" class="btn-run" style="width:100%; margin-top:8px;">Masuk</button>
    </form>

    <p class="auth-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
</div>

</body>
</html>