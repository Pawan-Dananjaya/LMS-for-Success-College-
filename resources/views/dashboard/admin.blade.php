@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="row g-3">
        <div class="col-lg-3">
            <div class="card p-3 stat-card">
                <h6>Total Students</h6>
                <h3>{{ $stats['total_students'] }}</h3>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-3 stat-card">
                <h6>Total Teachers</h6>
                <h3>{{ $stats['total_teachers'] }}</h3>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-3 stat-card">
                <h6>Total Courses</h6>
                <h3>{{ $stats['total_courses'] }}</h3>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-3 stat-card">
                <h6>Active Enrollments</h6>
                <h3>{{ $stats['active_enrollments'] }}</h3>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Courses</h5>
                    <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">All Courses</a>
                </div>
                <div class="card-body">
                    @if($recent_courses->isEmpty())
                        <div class="alert alert-info">No courses yet.</div>
                    @else
                        <ul class="list-group">
                            @foreach($recent_courses as $c)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $c->title }}</strong>
                                        <div class="small text-muted">By {{ $c->teacher->name ?? 'N/A' }} • Grades: {{ $c->grades ? implode(', ', $c->grades) : $c->grade_level }}</div>
                                    </div>
                                    <a href="{{ route('courses.show', $c->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent PDFs</h5>
                    <a href="{{ route('admin.pdfs') }}" class="btn btn-sm btn-outline-primary">Manage PDFs</a>
                </div>
                <div class="card-body">
                    @if($recent_pdfs->isEmpty())
                        <div class="alert alert-info">No PDFs yet.</div>
                    @else
                        <ul class="list-group">
                            @foreach($recent_pdfs as $p)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $p->original_name }}</strong>
                                        <div class="small text-muted">By {{ $p->uploader->name ?? 'N/A' }} • Course: {{ $p->course->title ?? 'None' }}</div>
                                    </div>
                                    @if(isset($p->type) && $p->type === 'db' && !empty($p->id))
                                        <a href="{{ route('pdf.download.byId', $p->id) }}" class="btn btn-sm btn-outline-secondary">Download</a>
                                    @else
                                        <a href="{{ asset('pdfs/' . $p->filename) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Download</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Students</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">All Students</a>
                </div>
                <div class="card-body">
                    @if($students->isEmpty())
                        <div class="alert alert-info">No students yet.</div>
                    @else
                        <ul class="list-group">
                            @foreach($students as $s)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $s->name }}</strong>
                                        <div class="small text-muted">{{ $s->email }} • Grade: {{ $s->grade }}</div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Teachers</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">All Teachers</a>
                </div>
                <div class="card-body">
                    @if($teachers->isEmpty())
                        <div class="alert alert-info">No teachers yet.</div>
                    @else
                        <ul class="list-group">
                            @foreach($teachers as $t)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $t->name }}</strong>
                                        <div class="small text-muted">{{ $t->email }}</div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
