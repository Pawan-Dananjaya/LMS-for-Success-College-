@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-book me-2"></i>Courses</h2>

        @auth
            @if(auth()->user()->isTeacher() || auth()->user()->isAdmin())
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-1"></i> Create Course
                </a>
            @endif
        @endauth
    </div>

    @if($courses->isEmpty())
        <div class="alert alert-info">No courses available yet.</div>
    @else
        <div class="row g-3">
            @foreach($courses as $course)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>

                            @if(!empty($course->grade_level) || !empty($course->subject))
                                <p class="card-text text-muted">
                                    @if(!empty($course->grade_level))
                                        Grade: {{ $course->grade_level }}
                                    @endif

                                    @if(!empty($course->subject))
                                        @if(!empty($course->grade_level)) — @endif
                                        {{ $course->subject }}
                                    @endif
                                </p>
                            @endif

                            <p class="card-text">{{ \Illuminate\Support\Str::limit($course->description ?? '', 120) }}</p>

                            <div class="mt-auto">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline-primary w-100">
                                    View course
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
