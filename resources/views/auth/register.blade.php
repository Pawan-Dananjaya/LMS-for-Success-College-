@extends('layouts.app')

@section('title', 'Register - College LMS')

@section('styles')
<style>
/* Simple, clean, responsive styles (matches the girl's DB fields) */
.wrapper {
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
  padding:20px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.card {
  width:100%;
  max-width:540px;
  background: #fff;
  border-radius:14px;
  box-shadow: 0 18px 40px rgba(0,0,0,0.18);
  overflow:hidden;
}
.header {
  background: linear-gradient(135deg,#6c5ce7,#a29bfe);
  color:#fff;
  text-align:center;
  padding:22px;
}
.brand-img{ width:72px;height:72px;border-radius:50%;border:3px solid rgba(255,255,255,0.15);object-fit:cover; display:inline-block; }
.body { padding:22px; }
.input-group-text { background:#f6f7fb;border:2px solid #eef1f6;border-right:none;border-radius:10px 0 0 10px; }
.form-control, .form-select { border:2px solid #eef1f6;border-left:none;border-radius:0 10px 10px 0;padding:10px 12px; }
.form-control:focus, .form-select:focus { border-color: rgba(108,92,231,0.9); box-shadow:0 0 0 0.12rem rgba(108,92,231,0.12); outline:none; }
.btn-primary { background: linear-gradient(135deg,#6c5ce7,#764ba2); color:#fff; border:none; padding:12px; border-radius:10px; width:100%; font-weight:700; }
.small-error { color:#d63384; font-size:0.88rem; margin-top:6px; display:block; }
.disabled { opacity:0.6; pointer-events:none; }
@media (max-width:520px){ .body{padding:16px} .header{padding:18px} }
</style>
@endsection

@section('content')
<div class="wrapper" role="main" aria-labelledby="register-heading">
  <div class="card" role="region" aria-label="Register panel">
    <div class="header">
      <img src="{{ asset('image/logo.png') }}" alt="College LMS logo" class="brand-img"
           onerror="this.onerror=null;this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDE0TDE2IDExTDEyIDhWMTQiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xMiAyMkM2LjQ3cyAyMiAyIDE3LjUyMyAyIDEyQzIgNi40NzcgNi40NzcgMiAxMiAyQzE3LjUyMyAyIDIyIDYuNDc3IDIyIDEyQzIyIDE3LjUyMyAxNy41MjMgMjIgMTIgMjIiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMiIvPgo8L3N2Zz4K';">
      <h3 id="register-heading" style="margin:8px 0 0;">Success College LMS</h3>
      <p style="margin:6px 0 0; opacity:.95">Create your account</p>
    </div>

    <div class="body">
      @if(session('success'))
        <div class="alert alert-success" role="status"><i class="fas fa-check-circle me-1"></i> {{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
        @csrf

        <!-- Full Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
          </div>
          @error('name') <span class="small-error">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="Enter your email" required>
          </div>
          @error('email') <span class="small-error">{{ $message }}</span> @enderror
        </div>

        <div class="row gx-2">
          <!-- Role -->
          <div class="col-md-6 mb-3">
            <label for="role" class="form-label">I am a</label>
            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
              <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select role</option>
              <option value="student" {{ old('role')=='student' ? 'selected' : '' }}>Student</option>
              <option value="teacher" {{ old('role')=='teacher' ? 'selected' : '' }}>Teacher</option>
            </select>
            @error('role') <span class="small-error">{{ $message }}</span> @enderror
          </div>

          <!-- Grade (For Students Only) -->
          <div class="col-md-6 mb-3" id="gradeWrapper">
            <label for="grade" class="form-label">Grade Level <span class="text-danger">*</span></label>
            <select id="grade" name="grade" class="form-select @error('grade') is-invalid @enderror">
                <option value="" disabled {{ old('grade') ? '' : 'selected' }}>Select your grade</option>
                <option value="1" {{ old('grade')=='1' ? 'selected' : '' }}>Grade 1</option>
                <option value="2" {{ old('grade')=='2' ? 'selected' : '' }}>Grade 2</option>
                <option value="3" {{ old('grade')=='3' ? 'selected' : '' }}>Grade 3</option>
                <option value="4" {{ old('grade')=='4' ? 'selected' : '' }}>Grade 4</option>
                <option value="5" {{ old('grade')=='5' ? 'selected' : '' }}>Grade 5</option>
            </select>
            <small class="text-muted">Select your current grade level</small>
            @error('grade') <span class="small-error">{{ $message }}</span> @enderror
          </div>
        </div>

        <!-- WhatsApp -->
        <div class="mb-3">
          <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
            <input id="whatsapp_number" name="whatsapp_number" type="text" class="form-control"
                   value="{{ old('whatsapp_number') }}" placeholder="Enter your WhatsApp number">
          </div>
          @error('whatsapp_number') <span class="small-error">{{ $message }}</span> @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-home"></i></span>
            <input id="address" name="address" type="text" class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address') }}" placeholder="Enter your address" required>
          </div>
          @error('address') <span class="small-error">{{ $message }}</span> @enderror
        </div>

        <div class="row gx-2">
          <!-- Password -->
          <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                     placeholder="Create password" required>
            </div>
            @error('password') <span class="small-error">{{ $message }}</span> @enderror
          </div>

          <!-- Confirm -->
          <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                     placeholder="Confirm password" required>
            </div>
          </div>
        </div>

        <div class="d-grid mt-2">
          <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i> Create Account</button>
        </div>

        <div class="text-center mt-3">
          <small>Already have an account? <a href="{{ route('login') }}" style="color:#6c5ce7; font-weight:600">Sign in here</a></small>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const role = document.getElementById('role');
  const gradeWrapper = document.getElementById('gradeWrapper');
  const gradeSelect = document.getElementById('grade');

  function updateGrade() {
    if (!role || !gradeSelect) return;

    if (role.value === 'teacher') {
      gradeWrapper.classList.add('disabled');
      gradeSelect.disabled = true;
      gradeSelect.required = false;
      gradeSelect.value = '';
    } else {
      gradeWrapper.classList.remove('disabled');
      gradeSelect.disabled = false;
      // make grade required for students
      gradeSelect.required = true;
      if (!gradeSelect.value) {
        gradeSelect.value = '';
      }
    }
  }

  if (role) {
    role.addEventListener('change', updateGrade);
    updateGrade(); // initialize on load
  }
});
</script>
@endsection
