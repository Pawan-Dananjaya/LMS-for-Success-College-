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
                        <div class="mb-3">
                            <label class="form-label">Upload PDF</label>
                            <input type="file" name="pdf" class="form-control">
                        </div>
                        <button class="btn btn-primary">Upload</button>
                    </form>

                    <hr>

                    <h5>Existing PDFs</h5>
                    @if(empty($files))
                        <p>No PDFs found.</p>
                    @else
                        <ul class="list-group">
                            @foreach($files as $f)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ asset('pdfs/' . $f) }}" target="_blank">{{ $f }}</a>
                                    <form method="POST" action="{{ route('admin.pdfs.delete', $f) }}">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
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
