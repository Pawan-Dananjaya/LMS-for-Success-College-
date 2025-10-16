<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College LMS - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --secondary-color: #f9ca24;
            --background-gradient: linear-gradient(180deg, #c4c9ff, #fffde7);
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background-gradient);
            min-height: 100vh;
        }
        
        .navbar-brand {
            font-weight: bold;
            color: var(--primary-color) !important;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .sidebar {
            background: linear-gradient(180deg, #2c3e50, #34495e);
            min-height: 100vh;
        }
        
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: var(--primary-color);
        }
        
        .stat-card {
            border-radius: 15px;
            border-left: 4px solid var(--primary-color);
        }
    </style>
    @yield('styles')
</head>
<body>
    @auth
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80" height="80" class="rounded-circle border border-3 border-warning">
                        <h5 class="text-white mt-2">College LMS</h5>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('courses*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                                <i class="fas fa-book me-2"></i> Courses
                            </a>
                        </li>
                        @if(auth()->user()->isTeacher() || auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('courses/create') ? 'active' : '' }}" href="{{ route('courses.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Create Course
                            </a>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="mt-4 p-3 border-top">
                        <div class="text-white">
                            <small>Logged in as: <strong>{{ auth()->user()->name }}</strong></small><br>
                            <small>Role: <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span></small>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mt-3 rounded">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="py-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @else
    <!-- Content for non-authenticated users -->
    @yield('content')
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>