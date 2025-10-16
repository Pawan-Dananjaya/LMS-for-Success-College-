<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isTeacher()) {
            return $this->teacherDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_courses' => Course::count(),
            'active_enrollments' => Enrollment::where('status', 'active')->count(),
        ];

        $recent_courses = Course::with('teacher')->latest()->take(5)->get();

        return view('dashboard.admin', compact('stats', 'recent_courses'));
    }

    private function teacherDashboard()
    {
        $teacher_id = auth()->id();
        
        $stats = [
            'my_courses' => Course::where('teacher_id', $teacher_id)->count(),
            'total_students' => Enrollment::whereIn('course_id', 
                Course::where('teacher_id', $teacher_id)->pluck('id'))->count(),
            'published_courses' => Course::where('teacher_id', $teacher_id)
                                        ->where('is_published', true)->count(),
        ];

        $my_courses = Course::where('teacher_id', $teacher_id)->latest()->get();

        return view('dashboard.teacher', compact('stats', 'my_courses'));
    }

    private function studentDashboard()
    {
        $student_id = auth()->id();
        
        $enrollments = Enrollment::with('course')
            ->where('user_id', $student_id)
            ->where('status', 'active')
            ->get();

        $recommended_courses = Course::where('is_published', true)
            ->whereNotIn('id', $enrollments->pluck('course_id'))
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('dashboard.student', compact('enrollments', 'recommended_courses'));
    }
}