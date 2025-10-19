@extends('layouts.app')

@section('title', $title)

@section('styles')
<style>
    /* Main Container */
    body {
        background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* Hero Header */
    .hero-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulse 4s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.3; }
    }
    
    .hero-content {
        position: relative;
        z-index: 1;
    }
    
    .hero-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 25px;
    }
    
    .grade-badge-large {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255,255,255,0.3);
        padding: 12px 30px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        display: inline-block;
    }
    
    /* Welcome Alert */
    .welcome-alert {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: none;
        border-left: 5px solid #2196f3;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
    }
    
    .welcome-alert strong {
        color: #1976d2;
        font-size: 1.1rem;
    }
    
    /* Statistics Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }
    
    .stat-card.primary { border-top-color: #667eea; }
    .stat-card.success { border-top-color: #00b894; }
    .stat-card.warning { border-top-color: #f9ca24; }
    .stat-card.danger { border-top-color: #e17055; }
    
    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }
    
    .stat-icon.primary { color: #667eea; }
    .stat-icon.success { color: #00b894; }
    .stat-icon.warning { color: #f9ca24; }
    .stat-icon.danger { color: #e17055; }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #2d3436;
        margin: 5px 0;
    }
    
    .stat-label {
        color: #636e72;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    /* PDF Card - Enhanced */
    .pdf-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }
    
    .pdf-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 50%, #f9ca24 100%);
    }
    
    .pdf-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    
    /* Grade Badge */
    .grade-badge {
        background: linear-gradient(135deg, #f9ca24 0%, #f0932b 100%);
        color: white;
        padding: 10px 25px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 800;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(249, 202, 36, 0.4);
        letter-spacing: 0.5px;
    }
    
    /* PDF Title Section */
    .pdf-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px dashed #e9ecef;
    }
    
    .pdf-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }
    
    .pdf-icon-wrapper i {
        font-size: 2rem;
        color: white;
    }
    
    .pdf-title {
        flex: 1;
    }
    
    .pdf-title h2 {
        color: #2d3436;
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 5px 0;
    }
    
    .pdf-title p {
        color: #636e72;
        margin: 0;
        font-size: 0.95rem;
    }
    
    /* Meta Information */
    .pdf-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 12px 18px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }
    
    .meta-item:hover {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-color: #2196f3;
        transform: translateX(5px);
    }
    
    .meta-item i {
        font-size: 1.3rem;
    }
    
    .meta-item .meta-label {
        display: flex;
        flex-direction: column;
    }
    
    .meta-item .meta-label strong {
        font-size: 0.85rem;
        color: #2d3436;
        font-weight: 700;
    }
    
    .meta-item .meta-label small {
        font-size: 0.75rem;
        color: #636e72;
    }
    
    /* Features List */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        border-radius: 12px;
        border: 2px dashed #dee2e6;
    }
    
    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background: white;
        border-radius: 8px;
        border-left: 3px solid #00b894;
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        transform: translateX(5px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .feature-item i {
        color: #00b894;
        font-size: 1.2rem;
    }
    
    .feature-item span {
        color: #2d3436;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    /* Description Box */
    .description-box {
        background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
        padding: 25px;
        border-radius: 15px;
        border-left: 5px solid #667eea;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.1);
    }
    
    .description-box h4 {
        color: #667eea;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .description-box p {
        color: #2d3436;
        line-height: 1.8;
        margin: 0;
        font-size: 1.05rem;
    }
    
    /* PDF Viewer Container */
    .viewer-container {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .viewer-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #dee2e6;
    }
    
    .viewer-header h4 {
        color: #2d3436;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .viewer-header .viewer-controls {
        display: flex;
        gap: 10px;
    }
    
    .viewer-btn {
        background: white;
        border: 2px solid #dee2e6;
        padding: 8px 15px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #636e72;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .viewer-btn:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .pdf-frame {
        border-radius: 15px;
        border: 3px solid #dee2e6;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        background: white;
    }
    
    /* Loading Overlay */
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.98);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        z-index: 10;
    }
    
    .spinner-wrapper {
        text-align: center;
    }
    
    .spinner {
        width: 60px;
        height: 60px;
        border: 6px solid #f3f3f3;
        border-top: 6px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 20px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .loading-text {
        color: #2d3436;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    
    .loading-subtext {
        color: #636e72;
        font-size: 0.9rem;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
    }
    
    .btn-action {
        flex: 1;
        min-width: 200px;
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
    }
    
    .btn-download {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }
    
    .btn-download:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.6);
        color: white;
    }
    
    .btn-print {
        background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(0, 184, 148, 0.4);
    }
    
    .btn-print:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 184, 148, 0.6);
    }
    
    .btn-view-fullscreen {
        background: linear-gradient(135deg, #f9ca24 0%, #f0932b 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(249, 202, 36, 0.4);
    }
    
    .btn-view-fullscreen:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(249, 202, 36, 0.6);
    }
    
    /* Divider */
    .section-divider {
        height: 3px;
        background: linear-gradient(90deg, transparent 0%, #667eea 20%, #764ba2 50%, #f9ca24 80%, transparent 100%);
        margin: 50px 0;
        border: none;
    }
    
    /* Back Button */
    .back-button-container {
        text-align: center;
        margin: 50px 0;
    }
    
    .btn-back {
        background: white;
        color: #667eea;
        border: 3px solid #667eea;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }
    
    .btn-back:hover {
        background: #667eea;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }
    
    /* Error State */
    .error-state {
        text-align: center;
        padding: 60px 40px;
        background: linear-gradient(135deg, #fff3cd 0%, #ffe5a1 100%);
        border-radius: 15px;
        border: 2px dashed #ffc107;
    }
    
    .error-state i {
        font-size: 4rem;
        color: #ff9800;
        margin-bottom: 20px;
    }
    
    .error-state h5 {
        color: #2d3436;
        font-weight: 700;
        margin-bottom: 15px;
    }
    
    .error-state p {
        color: #636e72;
        margin-bottom: 25px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .pdf-card {
            padding: 25px;
        }
        
        .pdf-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            min-width: 100%;
        }
        
        .stats-container {
            grid-template-columns: 1fr 1fr;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Print Styles */
    @media print {
        .hero-header, .welcome-alert, .action-buttons, .back-button-container {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Header -->
<div class="hero-header">
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">
                    <i class="fas fa-graduation-cap me-3"></i>{{ $title }}
                </h1>
                <p class="hero-subtitle">{{ $description }}</p>
            </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="grade-badge-large">
                    <i class="fas fa-user-graduate me-2"></i>
                    Your Grade: <strong>{{ auth()->check() ? auth()->user()->grade : 'N/A' }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Welcome Alert -->
    <div class="welcome-alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fas fa-info-circle fa-2x" style="color: #2196f3;"></i>
            <div>
                <strong>Welcome, {{ auth()->check() ? auth()->user()->name : 'Guest' }}!</strong>
                <p class="mb-0 mt-1" style="color: #1976d2;">
                    You have full access to all Grade {{ $gradeRange }} learning materials. Download PDFs for offline study!
                </p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="fas fa-file-pdf"></i>
            </div>
            <div class="stat-value">{{ count($grades) }}</div>
            <div class="stat-label">Available PDFs</div>
        </div>
        
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-value">90</div>
            <div class="stat-label">Days Program</div>
        </div>
        
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-download"></i>
            </div>
            <div class="stat-value">∞</div>
            <div class="stat-label">Unlimited Access</div>
        </div>
        
        <div class="stat-card danger">
            <div class="stat-icon danger">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="stat-value">100%</div>
            <div class="stat-label">Secure Access</div>
        </div>
    </div>

    <!-- PDF Materials Loop -->
    @foreach($grades as $grade)
        <div class="pdf-card" data-grade="{{ $grade }}">
            <!-- Grade Badge -->
            <span class="grade-badge">
                <i class="fas fa-award me-2"></i>Grade {{ $grade }}
            </span>
            
            <!-- PDF Header -->
            <div class="pdf-header">
                <div class="pdf-icon-wrapper">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="pdf-title">
                    <h2>ICT Learning Book - Grade {{ $grade }}</h2>
                    <p>Success International College - Godakawela</p>
                </div>
            </div>
            
            <!-- Meta Information -->
            <div class="pdf-meta">
                <div class="meta-item">
                    <i class="fas fa-file-pdf text-danger"></i>
                    <div class="meta-label">
                        <strong>PDF</strong>
                        <small>Document</small>
                    </div>
                </div>
                
                <div class="meta-item">
                    <i class="fas fa-clock text-info"></i>
                    <div class="meta-label">
                        <strong>90 Days</strong>
                        <small>Program</small>
                    </div>
                </div>
                
                <div class="meta-item">
                    <i class="fas fa-chart-line text-success"></i>
                    <div class="meta-label">
                        <strong>{{ $grade <= 2 ? 'Beginner' : 'Advanced' }}</strong>
                        <small>Level</small>
                    </div>
                </div>
                
                <div class="meta-item">
                    <i class="fas fa-tasks text-warning"></i>
                    <div class="meta-label">
                        <strong>Interactive</strong>
                        <small>Activities</small>
                    </div>
                </div>
            </div>
            
            <!-- Features Grid -->
            <div class="features-grid">
                @if($grade <= 2)
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Basic Skills</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Fun Activities</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Visual Learning</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Step-by-Step</span>
                    </div>
                @else
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Advanced Concepts</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Problem Solving</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Real Projects</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Internet Safety</span>
                    </div>
                @endif
            </div>
            
            <!-- Description -->
            <div class="description-box">
                <h4>
                    <i class="fas fa-book-open"></i>
                    About This Material
                </h4>
                <p>
                    @if($grade == 1)
                        This comprehensive PDF includes 90 days of engaging computer lessons specifically designed for Grade 1 students. 
                        Perfect for beginners to learn fundamental computer skills through fun, interactive activities that make learning enjoyable and effective.
                    @elseif($grade == 2)
                        Build upon foundational skills with this comprehensive Grade 2 ICT learning book. 
                        Includes interactive computer activities and projects that enhance digital literacy and prepare students for more advanced computer usage.
                    @elseif($grade == 3)
                        This comprehensive Grade 3 ICT learning book introduces advanced computer concepts 
                        through interactive exercises and quizzes. Students will develop critical thinking skills while exploring digital tools and technologies.
                    @elseif($grade == 4)
                        Master essential digital skills with this comprehensive Grade 4 ICT curriculum. 
                        Covers advanced topics with practical problem-solving activities and real-world applications that prepare students for the digital age.
                    @else
                        Prepare for advanced computer usage with this comprehensive Grade 5 ICT learning book. 
                        Covers typing mastery, file management, internet safety, and prepares students for more complex digital environments and challenges.
                    @endif
                </p>
            </div>
            
            <!-- PDF Viewer -->
            <div class="viewer-container">
                <div class="viewer-header">
                    <h4>
                        <i class="fas fa-eye"></i>
                        PDF Preview
                    </h4>
                    <div class="viewer-controls">
                        <button class="viewer-btn" onclick="toggleFullscreen({{ $grade }})" title="Fullscreen">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button class="viewer-btn" onclick="refreshPDF({{ $grade }})" title="Reload">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                
                <div class="position-relative">
                    <div class="loading-overlay" id="loading-{{ $grade }}">
                        <div class="spinner-wrapper">
                            <div class="spinner"></div>
                            <div class="loading-text">Loading PDF...</div>
                            <div class="loading-subtext">Please wait while we prepare your materials</div>
                        </div>
                    </div>
                    
                    <iframe 
                        id="pdf-frame-{{ $grade }}"
                        class="pdf-frame"
                        src="{{ asset('pdfs/ICT SIC - Grade ' . $grade . ' LMS.pdf') }}" 
                        width="100%" 
                        height="700px"
                        onload="hideLoading({{ $grade }})"
                        onerror="showError(this, {{ $grade }})">
                    </iframe>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('pdf.download', $grade) }}" class="btn-action btn-download">
                    <i class="fas fa-download"></i>
                    <span>Download PDF</span>
                </a>
                
                <button class="btn-action btn-print" onclick="printPDF({{ $grade }})">
                    <i class="fas fa-print"></i>
                    <span>Print PDF</span>
                </button>
                
                <button class="btn-action btn-view-fullscreen" onclick="openFullscreen({{ $grade }})">
                    <i class="fas fa-expand-arrows-alt"></i>
                    <span>View Fullscreen</span>
                </button>
            </div>
        </div>
        
        @if(!$loop->last)
            <hr class="section-divider">
        @endif
    @endforeach
    
    <!-- Back Button -->
    <div class="back-button-container">
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Dashboard</span>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Hide loading overlay
function hideLoading(grade) {
    const loading = document.getElementById('loading-' + grade);
    if (loading) {
        setTimeout(() => {
            loading.style.opacity = '0';
            loading.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                loading.style.display = 'none';
            }, 300);
        }, 800);
    }
}

// Show error state
function showError(iframe, grade) {
    const parent = iframe.parentElement;
    parent.innerHTML = `
        <div class="error-state">
            <i class="fas fa-exclamation-triangle"></i>
            <h5>PDF Preview Unavailable</h5>
            <p>Cannot preview Grade ${grade} PDF in your browser at this time.</p>
            <p class="mb-0">Please download the PDF to view it on your device.</p>
            <div class="mt-4">
                <a id="download-link-${grade}" class="btn-action btn-download" style="display: inline-flex;">
                    <i class="fas fa-download"></i>
                    <span>Download Grade ${grade} PDF</span>
                </a>
            </div>
        </div>
    `;
    // Build download URL safely and set it
    const downloadAnchor = document.getElementById(`download-link-${grade}`);
    if (downloadAnchor) {
        downloadAnchor.href = `{{ url('materials/download') }}/${grade}`;
    }
}

// Print PDF
function printPDF(grade) {
    const iframe = document.getElementById('pdf-frame-' + grade);
    if (iframe && iframe.contentWindow) {
        try {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        } catch (e) {
            console.error('Print error:', e);
            alert('Unable to print directly. Please download the PDF and print from your PDF viewer.');
        }
    }
}

// Toggle fullscreen for iframe
function toggleFullscreen(grade) {
    const iframe = document.getElementById('pdf-frame-' + grade);
    if (!document.fullscreenElement) {
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen();
        } else if (iframe.webkitRequestFullscreen) {
            iframe.webkitRequestFullscreen();
        } else if (iframe.msRequestFullscreen) {
            iframe.msRequestFullscreen();
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
}

// Open PDF in new window (fullscreen)
function openFullscreen(grade) {
    const pdfFileName = `ICT SIC - Grade ${grade} LMS.pdf`;
    const pdfUrl = "{{ asset('pdfs') }}" + '/' + encodeURIComponent(pdfFileName);
    window.open(pdfUrl, '_blank', 'fullscreen=yes,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes');
}

// Refresh PDF
function refreshPDF(grade) {
    const iframe = document.getElementById('pdf-frame-' + grade);
    const loading = document.getElementById('loading-' + grade);
    
    if (loading) {
        loading.style.display = 'flex';
        loading.style.opacity = '1';
    }
    
    if (iframe) {
        const currentSrc = iframe.src;
        iframe.src = '';
        setTimeout(() => {
            iframe.src = currentSrc;
        }, 100);
    }
}

// Smooth scroll animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate PDF cards on load
    const cards = document.querySelectorAll('.pdf-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 150 * index);
    });
    
    // Animate stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'scale(1)';
        }, 100 * index);
    });
    
    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe all feature items
    document.querySelectorAll('.feature-item').forEach(item => {
        observer.observe(item);
    });
    
    // Download tracking (optional - for analytics)
    document.querySelectorAll('.btn-download').forEach(btn => {
        btn.addEventListener('click', function() {
            const grade = this.closest('.pdf-card')?.dataset.grade;
            if (grade) {
                console.log('Downloading Grade ' + grade + ' PDF');
                // You can add analytics tracking here
            }
        });
    });
    
    // Add ripple effect to buttons
    document.querySelectorAll('.btn-action').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255,255,255,0.6);
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                transform: scale(0);
                animation: ripple-animation 0.6s ease-out;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // Smooth scroll to top button (appears after scrolling)
    const scrollBtn = document.createElement('button');
    scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 1000;
    `;
    
    document.body.appendChild(scrollBtn);
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollBtn.style.opacity = '1';
            scrollBtn.style.visibility = 'visible';
        } else {
            scrollBtn.style.opacity = '0';
            scrollBtn.style.visibility = 'hidden';
        }
    });
    
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    scrollBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 8px 30px rgba(102, 126, 234, 0.6)';
    });
    
    scrollBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = '0 5px 20px rgba(102, 126, 234, 0.4)';
    });
    
    // Add print styles
    window.addEventListener('beforeprint', function() {
        document.querySelectorAll('.hero-header, .welcome-alert, .action-buttons, .back-button-container, .scroll-to-top').forEach(el => {
            el.style.display = 'none';
        });
    });
    
    window.addEventListener('afterprint', function() {
        document.querySelectorAll('.hero-header, .welcome-alert, .action-buttons, .back-button-container').forEach(el => {
            el.style.display = '';
        });
    });
});

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .animate-in {
        animation: slideInLeft 0.5s ease forwards;
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    /* Hover effects for meta items */
    .meta-item {
        position: relative;
        overflow: hidden;
    }
    
    .meta-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .meta-item:hover::after {
        left: 100%;
    }
    
    /* Pulse animation for grade badge */
    .grade-badge {
        animation: pulse-badge 2s infinite;
    }
    
    @keyframes pulse-badge {
        0%, 100% {
            box-shadow: 0 4px 15px rgba(249, 202, 36, 0.4);
        }
        50% {
            box-shadow: 0 6px 25px rgba(249, 202, 36, 0.6);
        }
    }
    
    /* Loading animation enhancement */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .viewer-container {
        animation: fadeIn 0.5s ease;
    }
    
    /* Responsive iframe sizing */
    @media (max-width: 768px) {
        .pdf-frame {
            height: 500px !important;
        }
    }
    
    /* Focus states for accessibility */
    .btn-action:focus,
    .viewer-btn:focus,
    .btn-back:focus {
        outline: 3px solid #667eea;
        outline-offset: 3px;
    }
    
    /* Print optimization */
    @media print {
        body {
            background: white;
        }
        
        .pdf-card {
            page-break-inside: avoid;
            box-shadow: none;
            border: 1px solid #ddd;
        }
        
        .viewer-container {
            display: none;
        }
        
        .description-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }
    }
`;
document.head.appendChild(style);

// Console greeting (optional - for developers)
console.log('%c🎓 Success International College LMS', 'color: #667eea; font-size: 20px; font-weight: bold;');
console.log('%cPDF Materials System v1.0', 'color: #636e72; font-size: 12px;');
console.log('%cDeveloped for Grade 1-5 ICT Education', 'color: #00b894; font-size: 12px;');
</script>

@endsection
