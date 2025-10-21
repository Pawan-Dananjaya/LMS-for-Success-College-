@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card stat-card p-3">
                <h5 class="mb-1">My Courses</h5>
                <p class="text-muted">You have <strong>{{ $stats['my_courses'] ?? 0 }}</strong> courses</p>
                <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">Create Course</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card stat-card p-3">
                <h5 class="mb-1">Published Courses</h5>
                <p class="text-muted">Published: <strong>{{ $stats['published_courses'] ?? 0 }}</strong></p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card stat-card p-3">
                <h5 class="mb-1">Students</h5>
                <p class="text-muted">Total students across your courses: <strong>{{ $stats['total_students'] ?? 0 }}</strong></p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Courses</h5>
                    <a href="{{ route('courses.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus me-1"></i> New Course</a>
                </div>
                <div class="card-body">
                    @if($my_courses->isEmpty())
                        <div class="alert alert-info">You haven't created any courses yet.</div>
                    @else
                        <div class="list-group">
                            @foreach($my_courses as $course)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $course->title }}</h6>
                                        <small class="text-muted">Grade {{ $course->grade_level }} &middot; {{ $course->subject }}</small>
                                    </div>
                                    <div>
                                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary me-2">View</a>
                                        <a href="{{ route('lessons.create', $course->id) }}" class="btn btn-sm btn-primary">Add Lesson</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card p-3">
                <h5>PDF Materials</h5>
                <p class="text-muted">Manage grade-level PDF materials for students.</p>
                <a href="{{ route('admin.pdfs') }}" class="btn btn-sm btn-warning"><i class="fas fa-file-pdf me-1"></i> Manage PDFs</a>
            </div>
        </div>
    </div>
</div>
@endsection
