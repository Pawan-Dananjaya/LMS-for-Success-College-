@extends('layouts.app')

@section('title', 'Login - College LMS')

@section('styles')
<style>
/* Combined, responsive, accessible styles */
.auth-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 24px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.auth-card {
    width: 100%;
    max-width: 420px;
    background: rgba(255,255,255,0.98);
    border-radius: 18px;
    box-shadow: 0 18px 50px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: floatIn 0.45s ease;
}

@keyframes floatIn {
    from { opacity: 0; transform: translateY(20px) }
    to   { opacity: 1; transform: translateY(0) }
}

.auth-header {
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    color: #fff;
    padding: 26px 20px;
    text-align: center;
}

.auth-header .brand-img {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.2);
    object-fit: cover;
    display: inline-block;
    background: rgba(255,255,255,0.06);
    margin-bottom: 12px;
}

.auth-header h2 {
    margin: 6px 0 0;
    font-size: 1.35rem;
    font-weight: 700;
}

.auth-header p {
    margin: 6px 0 0;
    opacity: 0.95;
    font-size: 0.95rem;
}

.auth-body {
    padding: 26px;
}

.form-label {
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 8px;
}

.input-group .input-group-text {
    background: #f6f7fb;
    border: 2px solid #eef1f6;
    border-right: none;
    border-radius: 10px 0 0 10px;
}

.form-control {
    border: 2px solid #eef1f6;
    border-left: none;
    border-radius: 0 10px 10px 0;
    padding: 12px 14px;
    transition: all 0.15s ease;
}

.form-control:focus {
    border-color: rgba(108,92,231,0.9);
    box-shadow: 0 0 0 0.15rem rgba(108,92,231,0.12);
    outline: none;
}

.btn-login {
    background: linear-gradient(135deg,#6c5ce7,#764ba2);
    border: none;
    color: #fff;
    padding: 12px;
    border-radius: 10px;
    font-weight: 700;
    width: 100%;
    box-shadow: 0 6px 18px rgba(108,92,231,0.25);
    transition: transform 0.15s ease, box-shadow 0.15s ease;
}

.btn-login:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(108,92,231,0.32); }

.small-link { font-size: 0.92rem; color: #6c5ce7; text-decoration: none; }
.small-link:hover { text-decoration: underline; }

.alert-inline {
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 14px;
}

.password-toggle {
    cursor: pointer;
    user-select: none;
}

/* responsive tweaks */
@media (max-width: 480px) {
    .auth-card { margin: 10px; }
    .auth-body { padding: 18px; }
    .auth-header { padding: 20px; }
}
</style>
@endsection

@section('content')
<div class="auth-wrapper" role="main" aria-labelledby="login-heading">
    <div class="auth-card" role="region" aria-label="Login panel">
        <div class="auth-header">
            <img
                src="{{ asset('image/logo.png') }}"
                alt="{{ config('app.name', 'College LMS') }} logo"
                class="brand-img"
                onerror="this.onerror=null; this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDE0TDE2IDExTDEyIDhWMTQiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xMiAyMkM2LjQ3cyAyMiAyIDE3LjUyMyAyIDEyQzIgNi40NzcgNi40NzcgMiAxMiAyQzE3LjUyMyAyIDIyIDYuNDc3IDIyIDEyQzIyIDE3LjUyMyAxNy41MjMgMjIgMTIgMjIiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMiIvPgo8L3N2Zz4K';">
            <h2 id="login-heading">Welcome Back!</h2>
            <p class="mb-0">Sign in to access your learning materials</p>
        </div>

        <div class="auth-body">
            {{-- Session messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-inline" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('status'))
                <div class="alert alert-info alert-inline" role="status">
                    <i class="fas fa-info-circle me-2"></i> {{ session('status') }}
                </div>
            @endif

            {{-- General error (not field-specific) --}}
            @if($errors->has('email') === false && $errors->has('password') === false && $errors->any())
                <div class="alert alert-danger alert-inline" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group" role="group" aria-label="Email input group">
                        <span class="input-group-text" id="email-icon"><i class="fas fa-envelope"></i></span>
                        <input id="email"
                               type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="you@example.com"
                               aria-describedby="email-icon"
                               required
                               autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1" role="alert"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group" role="group" aria-label="Password input group">
                        <span class="input-group-text" id="password-icon"><i class="fas fa-lock"></i></span>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Enter your password"
                               aria-describedby="password-icon"
                               required>
                        <span class="input-group-text password-toggle" id="toggle-password" title="Show / hide password" role="button" aria-pressed="false">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1" role="alert"><strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                {{-- Submit --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-login" aria-label="Sign in">
                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                    </button>
                </div>

                {{-- Forgot password --}}
                @if (Route::has('password.request'))
                    <div class="text-center mb-2">
                        <a class="small-link" href="{{ route('password.request') }}">Forgot your password?</a>
                    </div>
                @endif

                {{-- Divider --}}
                <div style="text-align:center; margin:18px 0; color:#777;">
                    <small>OR</small>
                </div>

                <div class="text-center">
                    <span class="small-link">Don't have an account? <a href="{{ route('register') }}" class="small-link" style="font-weight:700">Create one</a></span>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Password toggle script --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('toggle-password');
    const password = document.getElementById('password');
    if (!toggle || !password) return;

    toggle.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.setAttribute('aria-pressed', type === 'text' ? 'true' : 'false');
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
});
</script>
@endsection
@endsection
