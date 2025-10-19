@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">PDF Materials for Grades 3, 4, and 5</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach([3,4,5] as $grade)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-info">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title">Grade {{ $grade }} PDF</h5>
                                    <p class="card-text">Download or view the learning materials for Grade {{ $grade }}.</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('pdf.grade', $grade) }}" class="btn btn-outline-primary w-100 mb-2" target="_blank">
                                            <i class="fas fa-eye me-2"></i>View PDF
                                        </a>
                                        <a href="{{ route('pdf.download', $grade) }}" class="btn btn-primary w-100">
                                            <i class="fas fa-download me-2"></i>Download PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection