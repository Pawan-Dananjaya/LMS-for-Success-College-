@extends('layouts.app')

@section('title', 'Pending User Approvals')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Pending User Approvals</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($users->isEmpty())
                        <p>No pending users at this time.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Submitted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.approve', $user->id) }}" style="display:inline-block">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reject', $user->id) }}" style="display:inline-block; margin-left:8px">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
