@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $user->whatsapp_number) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                        </div>

                        @if($user->isStudent())
                            <div class="mb-3">
                                <label class="form-label">Grade (1-5)</label>
                                <input type="number" name="grade" class="form-control" min="1" max="5" value="{{ old('grade', $user->grade) }}">
                            </div>
                        @endif

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">New Password (leave blank to keep current)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
