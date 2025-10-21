@extends('layouts.app')

@section('title', 'Manage PDFs')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">PDF Management</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.pdfs.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Upload PDF</label>
                                <input type="file" name="pdf" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Attach to Course (optional)</label>
                                <select name="course_id" class="form-select">
                                    <option value="">-- None --</option>
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->title }} ({{ $c->subject }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Grades (select one or more)</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @for($g=1;$g<=12;$g++)
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="grades[]" value="{{ $g }}"> <span class="form-check-label">Grade {{ $g }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <h5>Existing PDFs</h5>
                    @if($pdfs->isEmpty())
                        <p>No PDFs found.</p>
                    @else
                        <ul class="list-group">
                            @foreach($pdfs as $pdf)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ asset('pdfs/' . $pdf->filename) }}" target="_blank">{{ $pdf->original_name }}</a>
                                        <div class="text-muted small">
                                            Uploaded by: {{ $pdf->uploader->name ?? 'N/A' }}
                                            @if(!empty($pdf->created_at)) • {{ \Carbon\Carbon::parse($pdf->created_at)->diffForHumans() }} @endif
                                        </div>
                                        <div class="text-muted small">Course: {{ $pdf->course->title ?? 'None' }} • Grades: {{ $pdf->grades ? implode(', ', $pdf->grades) : 'All' }}</div>
                                    </div>
                                    <div class="btn-group">
                                        @if($pdf->type === 'db' && !empty($pdf->id))
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('pdf.download.byId', $pdf->id) }}">Download</a>
                                        @else
                                            <a class="btn btn-outline-secondary btn-sm" href="{{ asset('pdfs/' . $pdf->filename) }}" target="_blank">Download</a>
                                        @endif

                                        <form method="POST" action="{{ route('admin.pdfs.delete', $pdf->filename) }}">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
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
