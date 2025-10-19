@extends('layouts.app')

@section('title', 'Not Found')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <h1 class="display-4">404</h1>
        <p class="lead">The page you were looking for could not be found.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Go home</a>
    </div>
</div>
@endsection
