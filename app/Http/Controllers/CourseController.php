<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        // protect creation routes
        $this->middleware('auth')->only(['create', 'store']);
    }
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function create()
    {
        // allow only teachers or admins
        if (!auth()->check() || (!auth()->user()->isTeacher() && !auth()->user()->isAdmin())) {
            abort(403);
        }

        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grades' => 'required|array',
            'grades.*' => 'integer|min:1|max:12',
            'subject' => 'nullable|string|max:255',
        ]);

        // Only teachers or admins can create courses
        if (!auth()->check() || (!auth()->user()->isTeacher() && !auth()->user()->isAdmin())) {
            abort(403);
        }

        // Assign the current user as the teacher/creator to satisfy the non-null FK
        $data['teacher_id'] = auth()->id();

        // Save grades as array and keep a legacy grade_level for compatibility
        if (!empty($data['grades']) && is_array($data['grades'])) {
            $data['grades'] = array_values(array_map('intval', $data['grades']));
            $data['grade_level'] = (string) ($data['grades'][0] ?? '1');
        }

        try {
            \App\Models\Course::create($data);
        } catch (\Exception $e) {
            // Log and return a friendly error instead of raw exception output
            logger()->error('Course creation failed: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create course. Check logs for details.']);
        }

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function enroll($id)
    {
        // Add enrollment logic here
    }

    public function getByGrade($grade)
    {
        // Parse grade range if provided (e.g., "1-2" becomes [1,2])
        if (strpos($grade, '-') !== false) {
            list($min, $max) = explode('-', $grade);
            $courses = Course::whereBetween('grade_level', [$min, $max])
                        ->orWhereRaw("JSON_CONTAINS(grades, JSON_ARRAY(?))", [intval($min)])
                        ->get();
        } else {
            $g = intval($grade);
            $courses = Course::where('grade_level', $grade)
                        ->orWhereRaw("JSON_CONTAINS(grades, JSON_ARRAY(?))", [$g])
                        ->get();
        }

        return view('courses.grade', [
            'courses' => $courses,
            'grade' => $grade
        ]);
    }
}
