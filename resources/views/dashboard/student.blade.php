@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Student Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('courses.index') }}" class="btn btn-primary">
            <i class="fas fa-search me-1"></i> Browse Courses
        </a>
    </div>
</div>

<!-- Welcome Message -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="card-title">Welcome back, {{ auth()->user()->name }}! 👋</h4>
                        <p class="card-text">Continue your learning journey. You have {{ $enrollments->count() }} active courses.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-graduation-cap fa-4x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- My Courses -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-book me-2"></i>My Courses
                </h5>
            </div>
            <div class="card-body">
                @if($enrollments->count() > 0)
                <div class="row">
                    @foreach($enrollments as $enrollment)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title">{{ $enrollment->course->title }}</h6>
                                <p class="card-text small text-muted">
                                    <i class="fas fa-user-tie me-1"></i> {{ $enrollment->course->teacher->name }}<br>
                                    <i class="fas fa-chart-line me-1"></i> Progress: {{ $enrollment->progress }}%<br>
                                    <i class="fas fa-layer-group me-1"></i> {{ $enrollment->course->lessons->count() }} lessons
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="{{ route('courses.show', $enrollment->course->id) }}" class="btn btn-sm btn-primary w-100">
                                    Continue Learning
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No courses enrolled yet</h5>
                    <p class="text-muted">Start your learning journey by enrolling in a course</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Browse Courses
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recommended Courses -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Recommended Courses
                </h5>
            </div>
            <div class="card-body">
                @if($recommended_courses->count() > 0)
                @foreach($recommended_courses as $course)
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">{{ $course->title }}</h6>
                        <p class="card-text small text-muted">
                            <i class="fas fa-user-tie me-1"></i> {{ $course->teacher->name }}<br>
                            <i class="fas fa-layer-group me-1"></i> {{ $course->lessons->count() }} lessons
                        </p>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary w-100">
                            View Course
                        </a>
                    </div>
                </div>
               