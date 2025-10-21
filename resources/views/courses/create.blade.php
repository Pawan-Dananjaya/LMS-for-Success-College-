@extends('layouts.app')

@section('title', 'Create Course')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create New Course</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title</label>
                            <input id="title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Grade Levels (select one or more)</label>
                            <div class="d-flex flex-wrap gap-2">
                                @for($g=1;$g<=12;$g++)
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="grades[]" value="{{ $g }}"> <span class="form-check-label">Grade {{ $g }}</span>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input id="subject" name="subject" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-success" type="submit"><i class="fas fa-save me-1"></i> Create Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
