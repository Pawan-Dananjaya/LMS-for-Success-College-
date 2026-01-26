@extends('layouts.app')

@section('title', 'Student Portal Login')

@section('styles')
<style>
    :root {
        --primary-navy: #14213d;
        --secondary-navy: #2c3e50;
        --accent-gold: #fca311;
        --text-dark: #1d1d1f;
        --text-muted: #6c757d;
    }

    /* === BACKGROUND & LAYOUT === */
    .auth-body-bg {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    /* Background Pattern (Subtle) */
    .auth-body-bg::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 30px 30px;
        transform: rotate(15deg);
    }

    /* === LOGIN CARD === */
    .login-card {
        background: rgba(255, 255, 255, 0.98);
        width: 100%;
        max-width: 450px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
        padding: 40px;
        position: relative;
        z-index: 10;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* === HEADER SECTION === */
    .auth-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .brand-logo-wrapper {
        width: 90px;
        height: 90px;
        background: white;
        border-radius: 50%;
        padding: 5px;
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .brand-logo {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    .auth-title {
        color: var(--primary-navy);
        font-weight: 800;
        font-size: 1.75rem;
        margin-bottom: 5px;
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    /* === FORM ELEMENTS === */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        color: var(--primary-navy);
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    .input-group-custom {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        color: #adb5bd;
        font-size: 1.1rem;
        transition: color 0.3s;
        z-index: 5;
    }

    .form-control-custom {
        width: 100%;
        padding: 14px 15px 14px 50px; /* space for icon */
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 1rem;
        color: var(--text-dark);
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .form-control-custom:focus {
        border-color: var(--primary-navy);
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(20, 33, 61, 0.1);
    }

    .form-control-custom:focus + .input-icon,
    .form-control-custom:focus ~ .input-icon {
        color: var(--primary-navy);
    }

    /* Password Toggle */
    .password-toggle {
        position: absolute;
        right: 15px;
        color: #adb5bd;
        cursor: pointer;
        transition: color 0.3s;
    }
    
    .password-toggle:hover { color: var(--primary-navy); }

    /* === BUTTONS === */
    .btn-login {
        background: var(--accent-gold);
        color: var(--primary-navy);
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-weight: 800;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(252, 163, 17, 0.2);
    }

    .btn-login:hover {
        background: #e59400;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(252, 163, 17, 0.3);
    }

    /* === LINKS & EXTRAS === */
    .forgot-link {
        color: var(--text-muted);
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .forgot-link:hover { color: var(--primary-navy); }

    .register-text {
        text-align: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #f1f1f1;
        font-size: 0.95rem;
        color: var(--text-muted);
    }

    .register-link {
        color: var(--primary-navy);
        font-weight: 700;
        text-decoration: none;
    }
    
    .register-link:hover { text-decoration: underline; }

    .form-check-input:checked {
        background-color: var(--primary-navy);
        border-color: var(--primary-navy);
    }
</style>
@endsection

@section('content')
<div class="auth-body-bg">
    <div class="login-card">
        
        <div class="auth-header">
            <div class="brand-logo-wrapper">
                <img src="{{ asset('image/logo.png') }}" alt="Success Logo" class="brand-logo">
            </div>
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to access the Success Learning Portal</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> Invalid credentials. Please try again.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-group-custom">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control-custom" 
                           placeholder="student@success.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email') <small class="text-danger fw-bold mt-1 d-block">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label mb-0">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot Password?</a>
                    @endif
                </div>
                <div class="input-group-custom">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" id="password" class="form-control-custom" 
                           placeholder="••••••••" required>
                    <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small text-muted" for="remember">
                        Keep me logged in on this device
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Secure Login <i class="fas fa-arrow-right ms-2" style="font-size: 0.9em;"></i>
            </button>

            <div class="register-text">
                Don't have an account yet? 
                <a href="{{ route('register') }}" class="register-link">Register Now</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>
@endsection