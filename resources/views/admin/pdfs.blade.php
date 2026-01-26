@extends('layouts.app')

@section('title', 'Manage Library Resources')

@section('styles')
<style>
    :root {
        --primary-navy: #14213d;
        --secondary-navy: #2c3e50;
        --accent-gold: #fca311;
        --text-dark: #1d1d1f;
        --bg-light: #f4f6f8;
        --white: #ffffff;
    }

    body {
        background-color: var(--bg-light);
        font-family: 'Nunito', sans-serif;
    }

    /* CARD STYLING */
    .admin-card {
        background: var(--white);
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }

    .card-header-custom {
        background: var(--primary-navy);
        color: white;
        padding: 20px 25px;
        border-bottom: 4px solid var(--accent-gold);
    }

    .card-header-custom h4 {
        font-weight: 700;
        margin: 0;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* FORM ELEMENTS */
    .form-label {
        font-weight: 700;
        color: var(--primary-navy);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-navy);
        box-shadow: 0 0 0 4px rgba(20, 33, 61, 0.1);
    }

    /* GRADE SELECTOR PILLS */
    .grade-selector {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .grade-checkbox {
        display: none;
    }

    .grade-label {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #6c757d;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
    }

    .grade-checkbox:checked + .grade-label {
        background: var(--primary-navy);
        color: var(--accent-gold);
        border-color: var(--primary-navy);
        box-shadow: 0 4px 10px rgba(20, 33, 61, 0.2);
    }

    /* BUTTONS */
    .btn-upload {
        background: var(--accent-gold);
        color: var(--primary-navy);
        font-weight: 800;
        padding: 12px 30px;
        border-radius: 8px;
        border: none;
        transition: all 0.3s;
    }

    .btn-upload:hover {
        background: #e59400;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(252, 163, 17, 0.3);
    }

    /* FILE LIST */
    .file-item {
        border-bottom: 1px solid #f1f1f1;
        padding: 20px;
        transition: background 0.2s;
    }

    .file-item:last-child {
        border-bottom: none;
    }

    .file-item:hover {
        background: #fcfcfc;
    }

    .file-icon {
        width: 50px;
        height: 50px;
        background: #ffebee;
        color: #c62828;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 20px;
    }

    .file-title {
        font-weight: 700;
        color: var(--primary-navy);
        text-decoration: none;
        font-size: 1.05rem;
    }

    .file-meta {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 4px;
    }

    .badge-grade {
        background: var(--secondary-navy);
        color: white;
        font-size: 0.75rem;
        padding: 4px 8px;
        border-radius: 4px;
        margin-right: 5px;
    }

    .btn-action-group .btn {
        padding: 6px 12px;
        border-radius: 6px;
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="admin-card">
                <div class="card-header-custom">
                    <h4><i class="fas fa-cloud-upload-alt"></i> Upload New Material</h4>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-4">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.pdfs.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Select PDF Document</label>
                                <input type="file" name="pdf" class="form-control" accept="application/pdf" required>
                                <div class="form-text text-muted"><i class="fas fa-info-circle me-1"></i> Only .pdf files allowed. Max size 10MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Attach to Course (Optional)</label>
                                <select name="course_id" class="form-select">
                                    <option value="">-- General Resource --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->title }} ({{ $c->subject }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label d-block mb-3">Target Grades</label>
                                <div class="grade-selector">
                                    @for($g=1; $g<=12; $g++)
                                        <label>
                                            <input type="checkbox" name="grades[]" value="{{ $g }}" class="grade-checkbox">
                                            <span class="grade-label">Grade {{ $g }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-12 text-end">
                                <button class="btn-upload">
                                    <i class="fas fa-paper-plane me-2"></i> Upload Document
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom bg-white text-dark border-bottom pb-3" style="background: white; color: var(--primary-navy); border-bottom: 2px solid #f1f1f1;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 style="font-size: 1.1rem;"><i class="fas fa-folder-open me-2 text-warning"></i> Library Resources</h4>
                        <span class="badge bg-light text-dark">{{ $pdfs->count() }} Files</span>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($pdfs->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-25"></i>
                            <p class="text-muted fw-bold">No documents found in the library.</p>
                        </div>
                    @else
                        <div class="file-list">
                            @foreach($pdfs as $pdf)
                                <div class="file-item d-flex align-items-center">
                                    <div class="file-icon flex-shrink-0">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>

                                    <div class="flex-grow-1">
                                        <a href="{{ asset('pdfs/' . $pdf->filename) }}" target="_blank" class="file-title">
                                            {{ $pdf->original_name }}
                                        </a>
                                        <div class="file-meta">
                                            <span class="me-3"><i class="fas fa-user-circle me-1"></i> {{ $pdf->uploader->name ?? 'System' }}</span>
                                            <span class="me-3"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($pdf->created_at)->format('M d, Y') }}</span>
                                            
                                            @if($pdf->course)
                                                <span class="text-primary fw-bold"><i class="fas fa-book me-1"></i> {{ $pdf->course->title }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-2">
                                            @if($pdf->grades)
                                                @foreach($pdf->grades as $grade)
                                                    <span class="badge-grade">Gr {{ $grade }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">All Grades</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="btn-action-group d-flex gap-2">
                                        @if($pdf->type === 'db' && !empty($pdf->id))
                                            <a href="{{ route('pdf.download.byId', $pdf->id) }}" class="btn btn-outline-secondary btn-sm" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <a href="{{ asset('pdfs/' . $pdf->filename) }}" target="_blank" class="btn btn-outline-secondary btn-sm" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif

                                        <form method="POST" action="{{ route('admin.pdfs.delete', $pdf->filename) }}" onsubmit="return confirm('Are you sure you want to delete this file?');">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection