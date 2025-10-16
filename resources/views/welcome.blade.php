@extends('layouts.app')

@section('title', 'Welcome to College LMS')
@section('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
        color: white;
        padding: 100px 0;
        text-align: center;
    }
    
    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
    }
    
    .feature-icon {
        font-size: 3rem;
        color: #6c5ce7;
        margin-bottom: 20px;
    }

    /* Enhanced PDF Section Styles */
    .lesson-section {
        display: none;
        background: #ffffff;
        margin: 40px auto;
        max-width: 1200px;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        text-align: left;
        border: 1px solid #f1f3f4;
    }

    .download-buttons {
        margin: 40px 0;
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 15px;
        border: 2px dashed #dee2e6;
    }

    .download-buttons a {
        text-decoration: none;
        display: inline-block;
        margin: 8px;
    }

    .pdf-button {
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        position: relative;
        overflow: hidden;
    }

    .pdf-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
        color: white;
    }

    .pdf-button:active {
        transform: translateY(-1px);
    }

    .back-button {
        background: linear-gradient(135deg, #f9ca24, #f0932b);
        color: #2d3436;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(240, 147, 43, 0.3);
    }

    .back-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(240, 147, 43, 0.4);
        color: #2d3436;
    }

    .grade-card {
        cursor: pointer;
        transition: all 0.4s ease;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        position: relative;
    }

    .grade-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .grade-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    }

    .pdf-viewer-container {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .pdf-viewer-container:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    iframe {
        border-radius: 12px;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    iframe:hover {
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }

    .pdf-section-title {
        color: #2d3436;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 3px solid;
        border-image: linear-gradient(135deg, #6c5ce7, #a29bfe) 1;
        font-weight: 700;
        font-size: 1.5em;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pdf-description {
        color: #636e72;
        font-size: 1.1em;
        line-height: 1.7;
        margin-bottom: 25px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #6c5ce7;
    }

    .grade-header {
        text-align: center;
        margin-bottom: 40px;
        padding: 30px;
        background: linear-gradient(135deg, #6c5ce7, #a29bfe);
        color: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(108, 92, 231, 0.3);
        position: relative;
        overflow: hidden;
    }

    .grade-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shine 3s infinite;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .pdf-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .pdf-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #636e72;
        font-size: 0.9em;
        background: #f8f9fa;
        padding: 8px 15px;
        border-radius: 20px;
        border: 1px solid #e9ecef;
    }

    .pdf-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }

    .pdf-feature {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 3px solid #6c5ce7;
    }

    .pdf-feature i {
        color: #6c5ce7;
        font-size: 1.2em;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        z-index: 10;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #6c5ce7;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent, #6c5ce7, transparent);
        margin: 40px 0;
        border: none;
    }

    .grade-badge {
        background: linear-gradient(135deg, #f9ca24, #f0932b);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .lesson-section {
            padding: 20px;
            margin: 20px auto;
        }
        
        .pdf-button, .back-button {
            padding: 12px 20px;
            font-size: 1em;
        }
        
        .download-buttons {
            padding: 20px;
        }
        
        .grade-header {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to Success College Learning Management System</h1>
                <p class="lead mb-4">Empowering education through technology. Access courses, learn at your own pace, and achieve academic excellence.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="{{ route('register') }}" class="btn btn-warning btn-lg px-4">
                        <i class="fas fa-user-plus me-2"></i>Get Started
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('image/logo.png') }}" alt="Learning Illustration" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Why Choose Our LMS?</h2>
            <p class="text-muted">Experience the future of education with our comprehensive features</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h4>Interactive Learning</h4>
                    <p class="text-muted">Engage with interactive content, videos, and assessments designed for effective learning.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4>Expert Instructors</h4>
                    <p class="text-muted">Learn from experienced teachers and industry professionals dedicated to your success.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Anywhere Access</h4>
                    <p class="text-muted">Access your courses from any device, anywhere, at any time that suits you.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grade Selection Section -->
<section class="py-5 bg-light" id="grade-selection">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Choose Your Grade Level</h2>
            <p class="text-muted">Select your grade to explore available courses and learning materials</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-5 mb-4">
                <div class="card grade-card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-child fa-4x text-primary"></i>
                        </div>
                        <h3 class="card-title">Grade 1–2</h3>
                        <p class="card-text text-muted">Foundational courses for young learners</p>
                        <button class="btn btn-primary mt-3" onclick="showLesson('grade1')">
                            <i class="fas fa-book-open me-2"></i>Explore Learning Materials
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="card grade-card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-user-graduate fa-4x text-warning"></i>
                        </div>
                        <h3 class="card-title">Grade 3–5</h3>
                        <p class="card-text text-muted">Advanced learning for intermediate students</p>
                        <button class="btn btn-warning mt-3" onclick="showLesson('grade3')">
                            <i class="fas fa-book-open me-2"></i>Explore Learning Materials
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grade 1-2 PDF Section -->
<div class="lesson-section container" id="grade1">
    <div class="grade-header">
        <h1><i class="fas fa-child me-2"></i>Grade 1-2 Learning Materials</h1>
        <p class="mb-0">Foundational ICT courses for young learners</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Grade 1 PDF -->
            <div class="pdf-viewer-container">
                <span class="grade-badge">Grade 1</span>
                <h2 class="pdf-section-title">
                    <i class="fas fa-book text-warning"></i>
                    ICT Learning Book - Grade 1
                </h2>
                
                <div class="pdf-meta">
                    <div class="pdf-meta-item">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Document</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-clock text-info"></i>
                        <span>90 Days Program</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-user-graduate text-success"></i>
                        <span>Beginner Level</span>
                    </div>
                </div>

                <div class="pdf-features">
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Basic Computer Skills</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Fun Activities</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Interactive Lessons</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Step-by-Step Guide</span>
                    </div>
                </div>

                <p class="pdf-description">
                    This comprehensive PDF includes 90 days of engaging computer lessons specifically designed for Grade 1 students. 
                    Perfect for beginners to learn fundamental computer skills through fun, interactive activities that make learning enjoyable.
                </p>

                <div class="position-relative">
                    <div class="loading-overlay" id="loading-grade1">
                        <div class="spinner"></div>
                    </div>
                    <iframe src="{{ asset('pdfs/ICT SIC - Grade 1 LMS.pdf') }}" width="100%" height="600px" 
                            onload="hideLoading('loading-grade1')" 
                            onerror="showError(this, 'Grade 1')">
                    </iframe>
                </div>
            </div>

            <!-- Grade 2 PDF -->
            <div class="pdf-viewer-container">
                <span class="grade-badge">Grade 2</span>
                <h2 class="pdf-section-title">
                    <i class="fas fa-book text-primary"></i>
                    ICT Learning Book - Grade 2
                </h2>
                
                <div class="pdf-meta">
                    <div class="pdf-meta-item">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Document</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-puzzle-piece text-info"></i>
                        <span>Interactive Activities</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-chart-line text-success"></i>
                        <span>Intermediate Level</span>
                    </div>
                </div>

                <div class="pdf-features">
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Advanced Skills</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Problem Solving</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Creative Projects</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Skill Building</span>
                    </div>
                </div>

                <p class="pdf-description">
                    Build upon foundational skills with this comprehensive Grade 2 ICT learning book. 
                    Includes more interactive computer activities and projects that enhance digital literacy 
                    and prepare students for advanced computer usage.
                </p>

                <div class="position-relative">
                    <div class="loading-overlay" id="loading-grade2">
                        <div class="spinner"></div>
                    </div>
                    <iframe src="{{ asset('pdfs/ICT SIC - Grade 2 LMS.pdf') }}" width="100%" height="600px" 
                            onload="hideLoading('loading-grade2')" 
                            onerror="showError(this, 'Grade 2')">
                    </iframe>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Download Buttons -->
            <div class="download-buttons">
                <h4 class="text-center mb-4">
                    <i class="fas fa-download me-2"></i>
                    Download Learning Materials
                </h4>
                <p class="text-center text-muted mb-4">Access offline copies of all learning materials</p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ asset('pdfs/ICT SIC - Grade 1 LMS.pdf') }}" download class="pdf-download-link">
                        <button class="pdf-button">
                            <i class="fas fa-download me-2"></i>
                            Download Grade 1 PDF
                        </button>
                    </a>
                    <a href="{{ asset('pdfs/ICT SIC - Grade 2 LMS.pdf') }}" download class="pdf-download-link">
                        <button class="pdf-button">
                            <i class="fas fa-download me-2"></i>
                            Download Grade 2 PDF
                        </button>
                    </a>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-4">
                <button class="back-button" onclick="backHome()">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Grade Selection
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Grade 3-5 PDF Section -->
<div class="lesson-section container" id="grade3">
    <div class="grade-header">
        <h1><i class="fas fa-user-graduate me-2"></i>Grade 3-5 Learning Materials</h1>
        <p class="mb-0">Advanced ICT courses for intermediate students</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Grade 3 PDF -->
            <div class="pdf-viewer-container">
                <span class="grade-badge">Grade 3</span>
                <h2 class="pdf-section-title">
                    <i class="fas fa-book text-info"></i>
                    ICT Learning Book - Grade 3
                </h2>
                
                <div class="pdf-meta">
                    <div class="pdf-meta-item">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Document</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-gamepad text-info"></i>
                        <span>Interactive Quizzes</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-brain text-success"></i>
                        <span>Advanced Level</span>
                    </div>
                </div>

                <div class="pdf-features">
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Advanced Concepts</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Interactive Exercises</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Skill Assessment</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Progress Tracking</span>
                    </div>
                </div>

                <p class="pdf-description">
                    This comprehensive Grade 3 ICT learning book introduces more advanced computer concepts 
                    through interactive exercises and quizzes. Students will develop critical thinking skills 
                    while exploring digital tools and technologies.
                </p>

                <div class="position-relative">
                    <div class="loading-overlay" id="loading-grade3">
                        <div class="spinner"></div>
                    </div>
                    <iframe src="{{ asset('pdfs/ICT SIC - Grade 3 LMS.pdf') }}" width="100%" height="600px" 
                            onload="hideLoading('loading-grade3')" 
                            onerror="showError(this, 'Grade 3')">
                    </iframe>
                </div>
            </div>

            <!-- Grade 4 PDF -->
            <div class="pdf-viewer-container">
                <span class="grade-badge">Grade 4</span>
                <h2 class="pdf-section-title">
                    <i class="fas fa-book text-success"></i>
                    ICT Learning Book - Grade 4
                </h2>
                
                <div class="pdf-meta">
                    <div class="pdf-meta-item">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Document</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-tools text-info"></i>
                        <span>Digital Skills</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-rocket text-success"></i>
                        <span>Expert Level</span>
                    </div>
                </div>

                <div class="pdf-features">
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Essential Digital Skills</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Problem Solving</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Creative Projects</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Real-world Applications</span>
                    </div>
                </div>

                <p class="pdf-description">
                    Master essential digital skills with this comprehensive Grade 4 ICT curriculum. 
                    Covers advanced topics with practical problem-solving activities and real-world 
                    applications that prepare students for the digital age.
                </p>

                <div class="position-relative">
                    <div class="loading-overlay" id="loading-grade4">
                        <div class="spinner"></div>
                    </div>
                    <iframe src="{{ asset('pdfs/ICT SIC - Grade 4 LMS.pdf') }}" width="100%" height="600px" 
                            onload="hideLoading('loading-grade4')" 
                            onerror="showError(this, 'Grade 4')">
                    </iframe>
                </div>
            </div>

            <!-- Grade 5 PDF -->
            <div class="pdf-viewer-container">
                <span class="grade-badge">Grade 5</span>
                <h2 class="pdf-section-title">
                    <i class="fas fa-book text-warning"></i>
                    ICT Learning Book - Grade 5
                </h2>
                
                <div class="pdf-meta">
                    <div class="pdf-meta-item">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Document</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-shield-alt text-info"></i>
                        <span>Internet Safety</span>
                    </div>
                    <div class="pdf-meta-item">
                        <i class="fas fa-graduation-cap text-success"></i>
                        <span>Master Level</span>
                    </div>
                </div>

                <div class="pdf-features">
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Typing Mastery</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>File Management</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Internet Safety</span>
                    </div>
                    <div class="pdf-feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Advanced Computer Usage</span>
                    </div>
                </div>

                <p class="pdf-description">
                    Prepare for advanced computer usage with this comprehensive Grade 5 ICT learning book. 
                    Covers essential topics including typing mastery, file management, internet safety, 
                    and prepares students for more complex digital environments.
                </p>

                <div class="position-relative">
                    <div class="loading-overlay" id="loading-grade5">
                        <div class="spinner"></div>
                    </div>
                    <iframe src="{{ asset('pdfs/ICT SIC - Grade 5 LMS.pdf') }}" width="100%" height="600px" 
                            onload="hideLoading('loading-grade5')" 
                            onerror="showError(this, 'Grade 5')">
                    </iframe>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Download Buttons -->
            <div class="download-buttons">
                <h4 class="text-center mb-4">
                    <i class="fas fa-download me-2"></i>
                    Download Learning Materials
                </h4>
                <p class="text-center text-muted mb-4">Access offline copies of all learning materials</p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ asset('pdfs/ICT SIC - Grade 3 LMS.pdf') }}" download class="pdf-download-link">
                        <button class="pdf-button">
                            <i class="fas fa-download me-2"></i>
                            Download Grade 3 PDF
                        </button>
                    </a>
                    <a href="{{ asset('pdfs/ICT SIC - Grade 4 LMS.pdf') }}" download class="pdf-download-link">
                        <button class="pdf-button">
                            <i class="fas fa-download me-2"></i>
                            Download Grade 4 PDF
                        </button>
                    </a>
                    <a href="{{ asset('pdfs/ICT SIC - Grade 5 LMS.pdf') }}" download class="pdf-download-link">
                        <button class="pdf-button">
                            <i class="fas fa-download me-2"></i>
                            Download Grade 5 PDF
                        </button>
                    </a>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center mt-4">
                <button class="back-button" onclick="backHome()">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to Grade Selection
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showLesson(grade) {
        // Hide grade selection section
        document.getElementById('grade-selection').style.display = 'none';
        
        // Show the selected lesson section
        document.getElementById(grade).style.display = 'block';
        
        // Scroll to the lesson section smoothly
        document.getElementById(grade).scrollIntoView({ behavior: 'smooth' });
    }
    
    function backHome() {
        // Hide all lesson sections
        document.querySelectorAll('.lesson-section').forEach(section => {
            section.style.display = 'none';
        });
        
        // Show grade selection section
        document.getElementById('grade-selection').style.display = 'block';
        
        // Scroll back to grade selection smoothly
        document.getElementById('grade-selection').scrollIntoView({ behavior: 'smooth' });
    }

    function hideLoading(loadingId) {
        const loadingElement = document.getElementById(loadingId);
        if (loadingElement) {
            loadingElement.style.display = 'none';
        }
    }

    function showError(iframeElement, gradeName) {
        const parent = iframeElement.parentNode;
        parent.innerHTML = `
            <div class="text-center py-5" style="background: #f8f9fa; border-radius: 12px; border: 2px dashed #dee2e6;">
                <i class="fas fa-file-pdf fa-4x text-danger mb-3"></i>
                <h4 class="text-danger mb-3">PDF Preview Unavailable</h4>
                <p class="text-muted mb-3">The ${gradeName} PDF cannot be loaded for preview at the moment.</p>
                <p class="text-muted mb-4">Please use the download button below to access the learning materials.</p>
                <button class="pdf-button" onclick="downloadPDF('${gradeName}')">
                    <i class="fas fa-download me-2"></i>
                    Download ${gradeName} PDF
                </button>
            </div>
        `;
    }

    function downloadPDF(gradeName) {
        // This function would handle the download logic
        // For now, it will just scroll to download section
        const downloadSection = document.querySelector('.download-buttons');
        if (downloadSection) {
            downloadSection.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Enhanced PDF loading handling
    document.addEventListener('DOMContentLoaded', function() {
        const iframes = document.querySelectorAll('iframe');
        iframes.forEach(iframe => {
            // Add loading state
            iframe.style.opacity = '0.8';
            iframe.style.transition = 'opacity 0.3s ease';
            
            iframe.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        });

        // Hide lesson sections by default
        document.querySelectorAll('.lesson-section').forEach(section => {
            section.style.display = 'none';
        });

        // Add click animation to download buttons
        document.querySelectorAll('.pdf-button').forEach(button => {
            button.addEventListener('click', function(e) {
                // Add ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.5);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });

    // Add CSS for ripple effect
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection