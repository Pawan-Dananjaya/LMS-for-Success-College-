@extends('layouts.app')

@section('title', $title)

@section('styles')
<style>
    :root {
        --primary-navy: #14213d;
        --secondary-navy: #2c3e50;
        --accent-gold: #fca311;
        --text-dark: #1d1d1f;
        --text-muted: #6c757d;
        --bg-light: #f4f6f8;
        --white: #ffffff;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.05);
        --shadow-md: 0 8px 24px rgba(0,0,0,0.08);
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Nunito', sans-serif;
        color: var(--text-dark);
    }

    /* === HERO SECTION === */
    .hero-header {
        background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
        color: white;
        padding: 80px 0 100px; /* Extra padding for overlap */
        position: relative;
        margin-bottom: -60px; /* overlaps the content below */
    }

    .hero-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 40px;
        background: var(--bg-light);
        border-radius: 40px 40px 0 0;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 10px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.8;
        font-weight: 300;
        max-width: 600px;
    }

    .user-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 50px;
        color: var(--accent-gold);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    /* === STATS CARDS === */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
        position: relative;
        z-index: 10;
    }

    .stat-card {
        background: var(--white);
        padding: 25px;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-icon.gold { background: rgba(252, 163, 17, 0.1); color: var(--accent-gold); }
    .stat-icon.blue { background: rgba(20, 33, 61, 0.1); color: var(--primary-navy); }
    .stat-icon.green { background: rgba(16, 185, 129, 0.1); color: #10b981; }

    .stat-info h3 { margin: 0; font-size: 1.5rem; font-weight: 800; color: var(--primary-navy); }
    .stat-info p { margin: 0; font-size: 0.85rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }

    /* === PDF DOCUMENT CARD === */
    .pdf-card {
        background: var(--white);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-sm);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .pdf-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .pdf-title-group h2 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary-navy);
        margin-bottom: 5px;
    }

    .grade-tag {
        background: var(--primary-navy);
        color: white;
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* === FEATURES GRID === */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
        color: var(--secondary-navy);
        font-weight: 600;
    }

    .feature-item i { color: var(--accent-gold); }

    /* === PDF VIEWER === */
    .viewer-container {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        background: #525659; /* Standard PDF Viewer Grey */
        position: relative;
    }

    .viewer-toolbar {
        background: #323639;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .viewer-btn {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .viewer-btn:hover { background: rgba(255,255,255,0.1); }

    .pdf-frame {
        width: 100%;
        height: 800px;
        border: none;
        display: block;
    }

    /* === ACTION BUTTONS === */
    .action-row {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }

    .btn-action {
        flex: 1;
        padding: 16px;
        border-radius: 8px;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-gold {
        background: var(--accent-gold);
        color: var(--primary-navy);
    }
    .btn-gold:hover { background: #e59400; transform: translateY(-2px); }

    .btn-navy {
        background: var(--primary-navy);
        color: white;
    }
    .btn-navy:hover { background: #0d1629; transform: translateY(-2px); }

    .btn-outline {
        border: 2px solid #e0e0e0;
        color: var(--text-dark);
        background: white;
    }
    .btn-outline:hover { border-color: var(--primary-navy); color: var(--primary-navy); }

    /* === LOADING & ERROR === */
    .loading-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 5;
    }
    
    .spinner {
        width: 40px; height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--accent-gold);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 15px;
    }

    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .action-row { flex-direction: column; }
        .pdf-frame { height: 500px; }
        .pdf-header { flex-direction: column; gap: 15px; }
    }
</style>
@endsection

@section('content')

<div class="hero-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="user-badge mb-3">
                    <i class="fas fa-user-circle"></i> 
                    Logged in as: {{ auth()->check() ? auth()->user()->name : 'Guest' }}
                </div>
                <h1 class="hero-title">{{ $title }}</h1>
                <p class="hero-subtitle">
                    Access your comprehensive curriculum materials. {{ $description }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="text-white">
                    <span style="opacity: 0.7; font-size: 0.9rem; display: block; margin-bottom: 5px;">CURRENT GRADE</span>
                    <span style="font-size: 3rem; font-weight: 800; color: var(--accent-gold); line-height: 1;">
                        {{ auth()->check() ? auth()->user()->grade : '--' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-book"></i></div>
            <div class="stat-info">
                <h3>{{ count($grades) }}</h3>
                <p>Available PDFs</p>
            </div>
        </div>
        <div class="stat-card gold">
            <div class="stat-icon gold"><i class="fas fa-calendar-alt"></i></div>
            <div class="stat-info">
                <h3>90</h3>
                <p>Day Program</p>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon green"><i class="fas fa-shield-alt"></i></div>
            <div class="stat-info">
                <h3>100%</h3>
                <p>Secure Access</p>
            </div>
        </div>
    </div>

    @foreach($grades as $grade)
    <div class="pdf-card" id="card-grade-{{ $grade }}">
        
        <div class="pdf-header">
            <div class="pdf-title-group">
                <span class="grade-tag mb-2 d-inline-block">Curriculum Material</span>
                <h2>ICT Learning Book - Grade {{ $grade }}</h2>
                <p class="text-muted mb-0">Success International College • Official Syllabus</p>
            </div>
            <div class="text-end">
                <span class="badge bg-light text-dark border p-2">
                    <i class="fas fa-layer-group me-1"></i> 
                    {{ $grade <= 2 ? 'Beginner Level' : 'Advanced Level' }}
                </span>
            </div>
        </div>

        <div class="features-grid">
            <div class="feature-item"><i class="fas fa-check-circle"></i> Full Syllabus Coverage</div>
            <div class="feature-item"><i class="fas fa-check-circle"></i> Interactive Exercises</div>
            <div class="feature-item"><i class="fas fa-check-circle"></i> Printable Worksheets</div>
            <div class="feature-item"><i class="fas fa-check-circle"></i> Offline Access</div>
        </div>

        <div class="alert alert-light border mb-4">
            <h5 class="fw-bold text-dark"><i class="fas fa-info-circle me-2 text-primary"></i>About this Module</h5>
            <p class="mb-0 text-muted small">
                @if($grade == 1)
                    Foundational computer skills for Grade 1. Covers mouse control, keyboard basics, and digital safety.
                @elseif($grade == 2)
                    Building on basics with introduction to painting software and simple word processing.
                @elseif($grade == 3)
                    Intermediate concepts including file management, internet navigation, and basic typing.
                @elseif($grade == 4)
                    Advanced word processing, introduction to presentation software, and research skills.
                @else
                    Pre-secondary preparation covering spreadhseets, advanced formatting, and coding logic.
                @endif
            </p>
        </div>

        <div class="viewer-container">
            <div class="viewer-toolbar">
                <span class="small fw-bold"><i class="fas fa-file-pdf me-2"></i>PREVIEW MODE</span>
                <div>
                    <button class="viewer-btn me-2" onclick="refreshPDF({{ $grade }})"><i class="fas fa-sync-alt"></i> Refresh</button>
                    <button class="viewer-btn" onclick="openFullscreen({{ $grade }})"><i class="fas fa-expand"></i> Expand</button>
                </div>
            </div>
            
            <div class="position-relative">
                <div class="loading-overlay" id="loading-{{ $grade }}">
                    <div class="spinner"></div>
                    <span class="fw-bold text-dark">Loading Document...</span>
                </div>

                <iframe 
                    id="pdf-frame-{{ $grade }}"
                    class="pdf-frame"
                    src="{{ asset('pdfs/ICT SIC - Grade ' . $grade . ' LMS.pdf') }}" 
                    onload="hideLoading({{ $grade }})"
                    onerror="showError(this, {{ $grade }})">
                </iframe>
            </div>
        </div>

        <div class="action-row">
            <a href="{{ route('pdf.download', $grade) }}" class="btn-action btn-gold">
                <i class="fas fa-download"></i> Download PDF
            </a>
            <button onclick="printPDF({{ $grade }})" class="btn-action btn-navy">
                <i class="fas fa-print"></i> Print Document
            </button>
            <button onclick="openFullscreen({{ $grade }})" class="btn-action btn-outline">
                <i class="fas fa-external-link-alt"></i> Open in New Tab
            </button>
        </div>

    </div>
    @endforeach

    <div class="text-center my-5">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fas fa-arrow-left me-2"></i> Return to Dashboard
        </a>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function hideLoading(grade) {
        const loader = document.getElementById('loading-' + grade);
        if(loader) loader.style.display = 'none';
    }

    function showError(iframe, grade) {
        iframe.parentElement.innerHTML = `
            <div class="text-center py-5 bg-white">
                <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                <h5>Preview Not Available</h5>
                <p class="text-muted">This browser does not support inline PDFs.</p>
                <a href="{{ url('materials/download') }}/${grade}" class="btn btn-primary btn-sm mt-2">Download Instead</a>
            </div>
        `;
    }

    function printPDF(grade) {
        const iframe = document.getElementById('pdf-frame-' + grade);
        if (iframe && iframe.contentWindow) {
            iframe.contentWindow.print();
        }
    }

    function refreshPDF(grade) {
        const iframe = document.getElementById('pdf-frame-' + grade);
        const loader = document.getElementById('loading-' + grade);
        if(loader) loader.style.display = 'flex';
        iframe.src = iframe.src;
    }

    function openFullscreen(grade) {
        const url = "{{ asset('pdfs/ICT SIC - Grade ') }}" + grade + " LMS.pdf";
        window.open(url, '_blank');
    }
</script>
@endsection