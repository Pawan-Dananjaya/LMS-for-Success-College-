@extends('layouts.app')

@section('title', 'Welcome to Success International College LMS')

@section('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 120px 0 80px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.3;
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        animation: fadeInUp 0.8s ease;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        margin-bottom: 2.5rem;
        opacity: 0.95;
        animation: fadeInUp 1s ease;
    }
    
    .cta-buttons {
        animation: fadeInUp 1.2s ease;
    }
    
    .btn-hero {
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }
    
    .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }
    
    .btn-primary-custom {
        background: #f9ca24;
        color: #2d3436;
        border: none;
    }
    
    .btn-primary-custom:hover {
        background: #f0b90b;
        color: #2d3436;
    }
    
    .btn-outline-custom {
        background: transparent;
        color: white;
        border: 2px solid white;
    }
    
    .btn-outline-custom:hover {
        background: white;
        color: #667eea;
    }
    
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        transition: all 0.4s ease;
        height: 100%;
        border: none;
    }
    
    .feature-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: rotate(360deg) scale(1.1);
    }
    
    .grade-section {
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        padding: 80px 0;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #2d3436;
    }
    
    .section-subtitle {
        font-size: 1.2rem;
        color: #636e72;
        margin-bottom: 3rem;
    }
    
    .grade-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        border: none;
        position: relative;
    }
    
    .grade-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }
    
    .grade-card:hover {
        transform: translateY(-20px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0,0,0,0.2);
    }
    
    .grade-icon-wrapper {
        width: 120px;
        height: 120px;
        margin: 30px auto 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .grade-icon-wrapper::after {
        content: '';
        position: absolute;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        opacity: 0.2;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 0.2;
        }
        50% {
            transform: scale(1.1);
            opacity: 0;
        }
    }
    
    .grade-icon {
        font-size: 3.5rem;
        color: white;
        position: relative;
        z-index: 1;
    }
    
    .grade-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 15px;
    }
    
    .grade-description {
        color: #636e72;
        font-size: 1.1rem;
        margin-bottom: 25px;
        padding: 0 20px;
    }
    
    .grade-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 15px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
    
    .grade-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
        color: white;
    }
    
    .stats-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
    }
    
    .stat-item {
        text-align: center;
        padding: 20px;
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 10px;
        color: #f9ca24;
    }
    
    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .auth-prompt {
        background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        text-align: center;
        margin: 60px 0;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }
    
    .auth-prompt h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .auth-prompt p {
        font-size: 1.2rem;
        margin-bottom: 25px;
        opacity: 0.95;
    }
    
    .floating-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }
    
    .shape {
        position: absolute;
        opacity: 0.1;
    }
    
    .shape-1 {
        width: 300px;
        height: 300px;
        background: white;
        border-radius: 50%;
        top: -150px;
        right: -150px;
    }
    
    .shape-2 {
        width: 200px;
        height: 200px;
        background: white;
        border-radius: 50%;
        bottom: -100px;
        left: -100px;
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .grade-title {
            font-size: 1.6rem;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>
    
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">Welcome to Success International College</h1>
                <p class="hero-subtitle">Learning Management System for ICT Education</p>
                <p class="lead mb-4" style="animation: fadeInUp 1.4s ease;">
                    Empowering young minds with digital literacy. Access interactive ICT courses 
                    designed specifically for Grade 1-5 students. Learn at your own pace with our 
                    comprehensive learning materials.
                </p>
                <div class="cta-buttons d-flex gap-3 flex-wrap">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-hero btn-primary-custom">
                            <i class="fas fa-user-plus me-2"></i>Register Now
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-hero btn-outline-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-hero btn-primary-custom">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0">
                <img src="{{ asset('image/logo.png') }}" alt="Success International College" 
                     class="img-fluid" style="max-height: 350px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3)); animation: fadeInUp 1s ease;">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" style="background: white;">
    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose Our LMS?</h2>
            <p class="section-subtitle">Experience the future of ICT education</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">Interactive Learning</h4>
                    <p class="text-muted">Engaging ICT content with interactive activities, exercises, and real-world examples that make learning fun and effective.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">Safe & Secure</h4>
                    <p class="text-muted">Protected learning environment with role-based access control ensuring students only access age-appropriate content.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h4 class="mb-3 fw-bold">Offline Access</h4>
                    <p class="text-muted">Download PDF materials for offline learning. Study anytime, anywhere without requiring constant internet connection.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Grade Levels</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Comprehensive Lessons</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">90+</div>
                    <div class="stat-label">Days of Learning</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Access Anytime</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grade Selection Section -->
<section class="grade-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Explore Our ICT Courses</h2>
            <p class="section-subtitle">Choose your grade level to discover comprehensive learning materials</p>
        </div>
        
        <div class="row justify-content-center g-4">
            <div class="col-lg-5 col-md-6">
                <div class="grade-card">
                    <div class="card-body p-4 text-center">
                        <div class="grade-icon-wrapper">
                            <i class="grade-icon fas fa-child"></i>
                        </div>
                        <h3 class="grade-title">Grade 1-2</h3>
                        <p class="grade-description">
                            Foundational ICT courses designed for young learners. Build basic computer skills 
                            through fun, interactive activities perfect for beginners.
                        </p>
                        <div class="mb-4">
                            <span class="badge bg-success me-2 mb-2" style="font-size: 0.9rem; padding: 8px 15px;">
                                <i class="fas fa-book me-1"></i>2 Learning Books
                            </span>
                            <span class="badge bg-info mb-2" style="font-size: 0.9rem; padding: 8px 15px;">
                                <i class="fas fa-clock me-1"></i>90 Days Program
                            </span>
                        </div>
                        @guest
                            <button class="grade-btn" onclick="showAuthPrompt()">
                                <i class="fas fa-lock me-2"></i>Login to Access
                            </button>
                        @else
                            @if(auth()->user()->grade <= 2)
                                <a href="{{ route('pdf.grade', '1-2') }}" class="grade-btn">
                                    <i class="fas fa-book-open me-2"></i>View Materials
                                </a>
                            @else
                                <button class="grade-btn" disabled style="opacity: 0.6; cursor: not-allowed;">
                                    <i class="fas fa-ban me-2"></i>Not Available
                                </button>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
            
            <div class="col-lg-5 col-md-6">
                <div class="grade-card">
                    <div class="card-body p-4 text-center">
                        <div class="grade-icon-wrapper" style="background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);">
                            <i class="grade-icon fas fa-user-graduate"></i>
                        </div>
                        <h3 class="grade-title">Grade 3-5</h3>
                        <p class="grade-description">
                            Advanced ICT learning for intermediate students. Master essential digital skills, 
                            internet safety, and prepare for more complex computer usage.
                        </p>
                        <div class="mb-4">
                            <span class="badge me-2 mb-2" style="background: #fdcb6e; color: #2d3436; font-size: 0.9rem; padding: 8px 15px;">
                                <i class="fas fa-book me-1"></i>3 Learning Books
                            </span>
                            <span class="badge mb-2" style="background: #e17055; font-size: 0.9rem; padding: 8px 15px;">
                                <i class="fas fa-rocket me-1"></i>Advanced Level
                            </span>
                        </div>
                        @guest
                            <button class="grade-btn" style="background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);" onclick="showAuthPrompt()">
                                <i class="fas fa-lock me-2"></i>Login to Access
                            </button>
                        @else
                            @if(auth()->user()->grade >= 3 && auth()->user()->grade <= 5)
                                <a href="{{ route('pdf.grade', '3-5') }}" class="grade-btn" style="background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);">
                                    <i class="fas fa-book-open me-2"></i>View Materials
                                </a>
                            @else
                                <button class="grade-btn" style="background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%); opacity: 0.6; cursor: not-allowed;" disabled>
                                    <i class="fas fa-ban me-2"></i>Not Available
                                </button>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Authentication Prompt (for guests) -->
@guest
<section class="py-5">
    <div class="container">
        <div class="auth-prompt">
            <h3><i class="fas fa-graduation-cap me-2"></i>Ready to Start Learning?</h3>
            <p>Create your account today and get instant access to our comprehensive ICT learning materials!</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5" style="border-radius: 50px; font-weight: 600;">
                    <i class="fas fa-user-plus me-2"></i>Register Now
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5" style="border-radius: 50px; font-weight: 600; border-width: 2px;">
                    <i class="fas fa-sign-in-alt me-2"></i>Already Have Account?
                </a>
            </div>
        </div>
    </div>
</section>
@endguest

<!-- Footer -->
<footer style="background: #2d3436; color: white; padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">Success International College</h5>
                <p class="text-light opacity-75">Godakawela, Sri Lanka</p>
                <p class="text-light opacity-75">Empowering students with quality ICT education</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5 class="mb-3">Quick Links</h5>
                <div class="d-flex flex-column align-items-md-end gap-2">
                    <a href="#" class="text-light text-decoration-none opacity-75">About Us</a>
                    <a href="#" class="text-light text-decoration-none opacity-75">Contact</a>
                    <a href="#" class="text-light text-decoration-none opacity-75">Privacy Policy</a>
                </div>
            </div>
        </div>
        <hr class="my-4 opacity-25">
        <div class="text-center text-light opacity-75">
            <p class="mb-0">&copy; 2024 Success International College. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    function showAuthPrompt() {
        alert('Please login or register to access learning materials!');
        window.location.href = '{{ route("login") }}';
    }
</script>
@endsection