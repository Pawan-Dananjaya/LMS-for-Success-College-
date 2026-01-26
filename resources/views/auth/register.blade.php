@extends('layouts.app')

@section('title', 'Student Registration')

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
        padding: 40px 20px;
        position: relative;
    }

    /* === REGISTER CARD === */
    .register-card {
        background: rgba(255, 255, 255, 0.98);
        width: 100%;
        max-width: 600px; /* Wider for 2-column layout */
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        padding: 40px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* === HEADER === */
    .auth-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    .brand-logo {
        width: 70px;
        height: 70px;
        margin-bottom: 15px;
    }

    .auth-title {
        color: var(--primary-navy);
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 5px;
    }

    .auth-subtitle {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    /* === FORM ELEMENTS === */
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
        z-index: 5;
    }

    .form-control-custom, .form-select-custom {
        width: 100%;
        padding: 12px 15px 12px 50px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 0.95rem;
        color: var(--text-dark);
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: var(--primary-navy);
        background: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(20, 33, 61, 0.1);
    }

    /* === BUTTONS === */
    .btn-register {
        background: var(--accent-gold);
        color: var(--primary-navy);
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-weight: 800;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(252, 163, 17, 0.2);
    }

    .btn-register:hover {
        background: #e59400;
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(252, 163, 17, 0.3);
    }

    .login-link {
        text-align: center;
        margin-top: 25px;
        font-size: 0.95rem;
        color: var(--text-muted);
    }
    
    .login-link a {
        color: var(--primary-navy);
        font-weight: 700;
        text-decoration: none;
    }

    /* === HELPER CLASSES === */
    .disabled-field {
        opacity: 0.5;
        pointer-events: none;
        background-color: #e9ecef;
    }
</style>
@endsection

@section('content')
<div class="auth-body-bg">
    <div class="register-card">
        
        <div class="auth-header">
            <img src="{{ asset('image/logo.png') }}" alt="Success Logo" class="brand-logo">
            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Join the Success International College Learning Portal</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <div class="input-group-custom">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" name="name" class="form-control-custom" 
                           placeholder="Enter your full name" value="{{ old('name') }}" required>
                </div>
                @error('name') <small class="text-danger fw-bold">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group-custom">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control-custom" 
                           placeholder="student@example.com" value="{{ old('email') }}" required>
                </div>
                @error('email') <small class="text-danger fw-bold">{{ $message }}</small> @enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">I am a...</label>
                    <div class="input-group-custom">
                        <i class="fas fa-user-tag input-icon"></i>
                        <select name="role" id="roleSelect" class="form-select-custom" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6" id="gradeContainer">
                    <label class="form-label">Grade Level <span class="text-danger">*</span></label>
                    <div class="input-group-custom">
                        <i class="fas fa-graduation-cap input-icon"></i>
                        <select name="grade" id="gradeSelect" class="form-select-custom">
                            <option value="" disabled selected>Select Grade</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                        </select>
                    </div>
                    @error('grade') <small class="text-danger fw-bold">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">WhatsApp Number</label>
                    <div class="input-group-custom">
                        <i class="fab fa-whatsapp input-icon"></i>
                        <input type="text" name="whatsapp_number" class="form-control-custom" 
                               placeholder="07X XXXXXXX" value="{{ old('whatsapp_number') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <div class="input-group-custom">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" name="address" class="form-control-custom" 
                               placeholder="Your City" value="{{ old('address') }}" required>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <div class="input-group-custom">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" class="form-control-custom" 
                               placeholder="Create password" required>
                    </div>
                    @error('password') <small class="text-danger fw-bold">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group-custom">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_confirmation" class="form-control-custom" 
                               placeholder="Repeat password" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus me-2"></i> Register Account
            </button>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login Here</a>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('roleSelect');
        const gradeSelect = document.getElementById('gradeSelect');
        const gradeContainer = document.getElementById('gradeContainer');

        function toggleGrade() {
            if(roleSelect.value === 'teacher') {
                gradeContainer.style.opacity = '0.5';
                gradeSelect.disabled = true;
                gradeSelect.required = false;
                gradeSelect.value = ""; // clear selection
            } else {
                gradeContainer.style.opacity = '1';
                gradeSelect.disabled = false;
                gradeSelect.required = true;
            }
        }

        roleSelect.addEventListener('change', toggleGrade);
        
        // Run on load in case of old input
        toggleGrade();
    });
</script>
@endsection