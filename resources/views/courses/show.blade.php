@extends('layouts.app')

@section('title', $course->title ?? 'Course')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ $course->title }}</h3>
                    <small class="text-muted">
                        Grades: {{ $course->grades ? implode(', ', $course->grades) : $course->grade_level }} &middot; {{ $course->subject }}
                    </small>
                </div>
                <div class="card-body">
                    <p>{{ $course->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
