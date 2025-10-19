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
                            <label for="grade_level" class="form-label">Grade Level</label>
                            <select id="grade_level" name="grade_level" class="form-select" required>
                                <option value="1">Grade 1</option>
                                <option value="2">Grade 2</option>
                                <option value="3">Grade 3</option>
                                <option value="4">Grade 4</option>
                                <option value="5">Grade 5</option>
                            </select>
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
