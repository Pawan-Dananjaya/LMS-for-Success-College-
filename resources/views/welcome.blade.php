@extends('layouts.app')

@section('title', 'Welcome | Success International College')

@section('styles')
<style>
    :root {
        --primary-blue: #14213d; /* Deep Academic Navy */
        --accent-gold: #fca311;  /* Success Gold */
        --light-gray: #e5e5e5;
        --text-dark: #1d1d1f;
        --soft-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fa;
    }

    /* HERO SECTION */
    .hero-section {
        background: linear-gradient(135deg, #14213d 0%, #2c3e50 100%);
        color: white;
        padding: 100px 0 160px; /* Extra padding bottom for the overlapping stats */
        position: relative;
        overflow: hidden;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
        margin-bottom: 40px;
        max-width: 600px;
    }

    /* PROFESSIONAL BUTTONS */
    .btn-custom {
        padding: 14px 36px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-primary-custom {
        background-color: var(--accent-gold);
        color: var(--primary-blue);
        border: none;
    }

    .btn-primary-custom:hover {
        background-color: #e59400;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(252, 163, 17, 0.3);
    }

    .btn-outline-custom {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(5px);
    }

    .btn-outline-custom:hover {
        background: white;
        color: var(--primary-blue);
    }

    /* FLOATING STATS BAR */
    .stats-container {
        margin-top: -100px; /* Pulls it up into the hero */
        position: relative;
        z-index: 10;
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: var(--soft-shadow);
    }

    .stat-item {
        border-right: 1px solid #eee;
    }
    
    .stat-item:last-child {
        border-right: none;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary-blue);
        display: block;
    }

    .stat-label {
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    /* SECTION TITLES */
    .section-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 10px;
        text-align: center;
    }

    .section-subtitle {
        text-align: center;
        color: #6c757d;
        margin-bottom: 60px;
        font-size: 1.1rem;
    }

    /* GRADE CARDS (The Main Feature) */
    .grade-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: none;
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .grade-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }

    .grade-header {
        height: 140px;
        background: var(--primary-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* Subtle pattern overlay for header */
    .grade-header::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(#ffffff 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.1;
    }

    .grade-icon {
        font-size: 3.5rem;
        color: var(--accent-gold);
        position: relative;
        z-index: 2;
    }

    .card-body {
        padding: 30px;
        text-align: center;
    }

    .grade-title {
        font-weight: 800;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .grade-desc {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .grade-btn {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }

    .btn-access {
        background-color: var(--primary-blue);
        color: white;
        border: none;
    }
    
    .btn-access:hover {
        background-color: #0d1629;
        color: white;
    }

    .btn-locked {
        background-color: #f8f9fa;
        color: #adb5bd;
        border: 1px solid #dee2e6;
        cursor: not-allowed;
    }

    /* FOOTER */
    .footer {
        background: #101929;
        color: white;
        padding: 60px 0 30px;
        margin-top: 80px;
    }
    
    .footer h5 {
        color: white;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .footer a {
        color: #adb5bd;
        text-decoration: none;
        display: block;
        margin-bottom: 10px;
        transition: color 0.2s;
    }

    .footer a:hover {
        color: var(--accent-gold);
    }

    /* Mobile Responsive Tweaks */
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .stats-container { margin-top: 0; border-radius: 0; }
        .stat-item { border-right: none; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
        .stat-item:last-child { border-bottom: none; margin-bottom: 0; }
    }
</style>
@endsection

@section('content')

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">
                    <i class="fas fa-star me-2"></i>Ranked #1 for ICT Education
                </span>
                <h1 class="hero-title">
                    Master Digital Skills at <span style="color: var(--accent-gold);">Success College</span>
                </h1>
                <p class="hero-subtitle">
                    Empowering the next generation with world-class ICT education. 
                    Interactive lessons, safe environments, and comprehensive resources for Grades 1-5.
                </p>
                <div class="d-flex gap-3">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-custom btn-primary-custom">
                            <i class="fas fa-user-plus me-2"></i>Start Learning
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-custom btn-outline-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-custom btn-primary-custom">
                            <i class="fas fa-columns me-2"></i>Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <img src="{{ asset('image/logo.png') }}" alt="Success College Logo" 
                     style="max-width: 80%; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.4)); animation: float 6s ease-in-out infinite;">
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="stats-container">
        <div class="row text-center">
            <div class="col-md-4 stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Active Students</span>
            </div>
            <div class="col-md-4 stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Interactive Lessons</span>
            </div>
            <div class="col-md-4 stat-item">
                <span class="stat-number">100%</span>
                <span class="stat-label">Success Rate</span>
            </div>
        </div>
    </div>
</div>

<section class="py-5 mt-4">
    <div class="container">
        <h2 class="section-title">Select Your Learning Path</h2>
        <p class="section-subtitle">Curriculum designed specifically for each developmental stage.</p>

        <div class="row g-4 justify-content-center">
            
            <div class="col-lg-4 col-md-6">
                <div class="grade-card">
                    <div class="grade-header">
                        <i class="grade-icon fas fa-shapes"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="grade-title">Junior ICT (Grades 1-2)</h3>
                        <p class="grade-desc">
                            Introduction to computers, mouse skills, and basic digital safety through fun games.
                        </p>
                        <div class="d-flex justify-content-between mb-4 small text-muted fw-bold">
                            <span><i class="fas fa-book me-1"></i> 2 Modules</span>
                            <span><i class="fas fa-clock me-1"></i> Beginner</span>
                        </div>

                        @guest
                            <button onclick="showAuthPrompt()" class="btn btn-custom btn-access w-100">
                                <i class="fas fa-lock me-2"></i>Login to Access
                            </button>
                        @else
                            @if(auth()->user()->grade <= 2)
                                <a href="{{ route('pdf.grade', '1-2') }}" class="btn btn-custom btn-access w-100">
                                    Access Materials
                                </a>
                            @else
                                <button class="btn btn-custom btn-locked w-100" disabled>
                                    Not Available
                                </button>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="grade-card">
                    <div class="grade-header" style="background: linear-gradient(135deg, #2c3e50 0%, #4ca1af 100%);">
                        <i class="grade-icon fas fa-laptop-code"></i>
                    </div>
                    <div class="card-body">
                        <h3 class="grade-title">Senior ICT (Grades 3-5)</h3>
                        <p class="grade-desc">
                            Advanced typing, introduction to coding logic, and software basics (Word/Paint).
                        </p>
                        <div class="d-flex justify-content-between mb-4 small text-muted fw-bold">
                            <span><i class="fas fa-book me-1"></i> 4 Modules</span>
                            <span><i class="fas fa-star me-1"></i> Advanced</span>
                        </div>

                        @guest
                            <button onclick="showAuthPrompt()" class="btn btn-custom btn-access w-100">
                                <i class="fas fa-lock me-2"></i>Login to Access
                            </button>
                        @else
                            @if(auth()->user()->grade >= 3 && auth()->user()->grade <= 5)
                                <a href="{{ route('pdf.grade', '3-5') }}" class="btn btn-custom btn-access w-100">
                                    Access Materials
                                </a>
                            @else
                                <button class="btn btn-custom btn-locked w-100" disabled>
                                    Not Available
                                </button>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="text-white">Success International College</h5>
                <p class="text-muted small">
                    Godakawela, Sri Lanka.<br>
                    Providing excellence in ICT education for over a decade.
                </p>
                <div class="mt-3">
                    <a href="#" class="d-inline me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="d-inline me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="d-inline"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Platform</h5>
                <a href="#">Home</a>
                <a href="#">Courses</a>
                <a href="#">Pricing</a>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Support</h5>
                <a href="#">Help Center</a>
                <a href="#">Contact Admin</a>
                <a href="#">Privacy Policy</a>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Contact</h5>
                <p class="text-muted small">
                    <i class="fas fa-envelope me-2"></i> info@successcollege.lk<br>
                    <i class="fas fa-phone me-2"></i> +94 11 234 5678
                </p>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <div class="text-center text-muted small mt-4">
            &copy; {{ date('Y') }} Success International College. All Rights Reserved.
        </div>
    </div>
</footer>

<script>
    function showAuthPrompt() {
        // You can replace this with a nice SweetAlert if you have it installed
        alert('Please login to access this course material!');
        window.location.href = '{{ route("login") }}';
    }
</script>

<style>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
</style>

@endsection