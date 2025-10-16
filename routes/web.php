<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Course Viewing
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('home'); // Redirect to home for now
    })->name('dashboard');

    
    // Course Management
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    
    // Lesson Management
    Route::get('/courses/{courseId}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/courses/{courseId}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/courses/{courseId}/lessons/{lessonId}', [LessonController::class, 'show'])->name('lessons.show');
});