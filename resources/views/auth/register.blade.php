<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - College LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #f9ca24;
            --background-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--primary-color), #a29bfe);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .register-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 15px;
        }
        
        .register-body {
            padding: 30px;
            max-height: 60vh;
            overflow-y: auto;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #a29bfe);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .register-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .register-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
        }
        
        .form-control {
            border-left: none;
        }
        
        .form-select {
            border-left: 2px solid #e9ecef;
        }
        
        .grade-field {
            transition: all 0.3s ease;
        }
        
        .grade-field.disabled {
            opacity: 0.6;
            pointer-events: none;
        }
        
        /* Custom scrollbar */
        .register-body::-webkit-scrollbar {
            width: 6px;
        }
        
        .register-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .register-body::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <img src="{{ asset('image/logo.png') }}" alt="College LMS Logo" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDE0TDE2IDExTDEyIDhWMTQiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0xMiAyMkM2LjQ3NyAyMiAyIDE3LjUyMyAyIDEyQzIgNi40NzcgNi40NzcgMiAxMiAyQzE3LjUyMyAyIDIyIDYuNDc3IDIyIDEyQzIyIDE3LjUyMyAxNy41MjMgMjIgMTIgMjIiIHN0cm9rZT0id2hpdGUiIHN0cm9rZS13aWR0aD0iMiIvPgo8L3N2Zz4K'">
            <h3 class="mb-0">Success College LMS</h3>
            <p class="mb-0 opacity-75">Create your account</p>
        </div>
        
        <div class="register-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email') }}" placeholder="Enter your email" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">I am a</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" disabled selected>Select your role</option>
                            <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        </select>
                        @error('role')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3 grade-field" id="gradeField">
                        <label for="grade" class="form-label">Grade Level</label>
                        <select class="form-select" id="grade" name="grade">
                            <option value="" selected>Select grade (Optional)</option>
                            <option value="Grade 1" {{ old('grade') == 'Grade 1' ? 'selected' : '' }}>Grade 1</option>
                            <option value="Grade 2" {{ old('grade') == 'Grade 2' ? 'selected' : '' }}>Grade 2</option>
                            <option value="Grade 3" {{ old('grade') == 'Grade 3' ? 'selected' : '' }}>Grade 3</option>
                            <option value="Grade 4" {{ old('grade') == 'Grade 4' ? 'selected' : '' }}>Grade 4</option>
                            <option value="Grade 5" {{ old('grade') == 'Grade 5' ? 'selected' : '' }}>Grade 5</option>
                            <option value="Other" {{ old('grade') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('grade')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number" 
                                   value="{{ old('whatsapp_number') }}" placeholder="Enter your WhatsApp number">
                        </div>
                        @error('whatsapp_number')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-home"></i>
                            </span>
                            <input type="text" class="form-control" id="address" name="address" 
                                   value="{{ old('address') }}" placeholder="Enter your address" required>
                        </div>
                        @error('address')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Create password" required>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password_confirmation" 
                                   name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </button>
                </div>
            </form>
        </div>
        
        <div class="register-footer">
            <p class="mb-0">Already have an account? 
                <a href="{{ route('login') }}">Sign in here</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide grade field based on role selection
        document.getElementById('role').addEventListener('change', function() {
            const gradeField = document.getElementById('gradeField');
            const gradeSelect = document.getElementById('grade');
            
            if (this.value === 'teacher') {
                gradeField.classList.add('disabled');
                gradeSelect.disabled = true;
                gradeSelect.required = false;
                // Set grade to empty for teachers
                gradeSelect.value = '';
            } else {
                gradeField.classList.remove('disabled');
                gradeSelect.disabled = false;
                gradeSelect.required = false; // Keep it optional
            }
        });

        // Initialize grade field state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const roleField = document.getElementById('role');
            const gradeField = document.getElementById('gradeField');
            const gradeSelect = document.getElementById('grade');
            
            if (roleField.value === 'teacher') {
                gradeField.classList.add('disabled');
                gradeSelect.disabled = true;
                gradeSelect.required = false;
            }
            
            // Set default value for grade if empty
            if (!gradeSelect.value) {
                gradeSelect.value = '';
            }
        });

        // Form submission handling
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const role = document.getElementById('role').value;
            const grade = document.getElementById('grade').value;
            
            // If teacher, ensure grade is empty
            if (role === 'teacher') {
                document.getElementById('grade').value = '';
            }
            
            // Form will submit normally, validation is handled server-side
        });
    </script>
</body>
</html>