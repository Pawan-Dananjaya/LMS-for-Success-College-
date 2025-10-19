<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Success International College LMS
|--------------------------------------------------------------------------
*/

// ============================================
// PUBLIC ROUTES (No login required)
// ============================================

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ============================================
// AUTHENTICATION ROUTES
// ============================================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// PUBLIC COURSE BROWSING (Anyone can view)
// ============================================

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// ============================================
// PROTECTED ROUTES (Login Required)
// ============================================

Route::middleware(['auth'])->group(function () {
    
    // ------------------------------------
    // DASHBOARD
    // ------------------------------------
    
    // Course routes by grade level
    Route::get('/courses/grade/{grade}', [CourseController::class, 'getByGrade'])->name('courses.grade');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ------------------------------------
    // COURSE MANAGEMENT (Teachers/Admins)
    // ------------------------------------
    
    // IMPORTANT: Specific routes BEFORE wildcard routes!
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    
    // Course enrollment (Students)
    Route::post('/courses/{id}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    
    // ------------------------------------
    // LESSON MANAGEMENT
    // ------------------------------------
    Route::get('/courses/{courseId}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/courses/{courseId}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/courses/{courseId}/lessons/{lessonId}', [LessonController::class, 'show'])->name('lessons.show');
    
    // ------------------------------------
    // PDF MATERIALS SYSTEM (NEW) ✨
    // ------------------------------------
    Route::prefix('materials')->name('pdf.')->group(function () {
        // Redirect to appropriate grade materials
        Route::get('/', [PDFController::class, 'index'])->name('index');
        
        // View specific grade materials (Grade 1-2 or 3-5)
        Route::get('/grade/{gradeRange}', [PDFController::class, 'showGrade'])->name('grade');
        
        // Download specific PDF with access control
        Route::get('/download/{grade}', [PDFController::class, 'downloadPDF'])->name('download');
    });
});

// Place wildcard course show route after other /courses routes to avoid collisions
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/pending-users', [\App\Http\Controllers\AdminController::class, 'pending'])->name('pending');
    Route::post('/approve-user/{id}', [\App\Http\Controllers\AdminController::class, 'approve'])->name('approve');
    Route::post('/reject-user/{id}', [\App\Http\Controllers\AdminController::class, 'reject'])->name('reject');
    // PDF management
    Route::get('/pdfs', [\App\Http\Controllers\AdminController::class, 'pdfs'])->name('pdfs');
    Route::post('/pdfs/upload', [\App\Http\Controllers\AdminController::class, 'uploadPdf'])->name('pdfs.upload');
    Route::post('/pdfs/delete/{filename}', [\App\Http\Controllers\AdminController::class, 'deletePdf'])->name('pdfs.delete');
});

// ============================================
// FALLBACK ROUTE (404 handler)
// ============================================
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Profile routes
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('update');
});