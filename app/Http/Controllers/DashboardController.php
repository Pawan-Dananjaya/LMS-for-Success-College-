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
        // Combine DB PDFs with filesystem PDFs for recent list
        $dbPdfs = \App\Models\Pdf::with('uploader','course')->get();
        $display = [];
        foreach ($dbPdfs as $p) {
            $display[] = (object)[
                'type' => 'db',
                'id' => $p->id,
                'filename' => $p->filename,
                'original_name' => $p->original_name,
                'uploader' => $p->uploader,
                'course' => $p->course,
                'created_at' => $p->created_at,
            ];
        }

        $path = public_path('pdfs');
        if (is_dir($path)) {
            $all = scandir($path);
            foreach ($all as $f) {
                if (in_array($f, ['.', '..'])) continue;
                if ($dbPdfs->where('filename', $f)->count() > 0) continue;
                $display[] = (object)[
                    'type' => 'file',
                    'filename' => $f,
                    'original_name' => $f,
                    'uploader' => null,
                    'course' => null,
                    'created_at' => filemtime($path . '/' . $f) ? \Carbon\Carbon::createFromTimestamp(filemtime($path . '/' . $f)) : null,
                ];
            }
        }

        // sort by created_at descending and take 8
        $recent_pdfs = collect($display)->sortByDesc(function($i){ return $i->created_at ? $i->created_at->timestamp : 0; })->values()->take(8);
        $students = User::where('role', 'student')->latest()->take(10)->get();
        $teachers = User::where('role', 'teacher')->latest()->take(10)->get();

        return view('dashboard.admin', compact('stats', 'recent_courses', 'recent_pdfs', 'students', 'teachers'));
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